from flask import Flask,jsonify,request,render_template
from face_detection import Face
from db import DB
import json

app     = Flask(__name__) #Инициализация Flask
db      = DB(app) #Инициализация БД
face    = Face()  #Инициализация класса для работы с лицом
 
@app.route('/') 
def index():
    return render_template('index.html')
     
#Создание вектора лица переданного изображения
@app.route('/api/vector-img', methods=['POST'])
def vector_img(): 
    if not request.json or not 'data' in request.json :
        return jsonify({'errors': "Не пришел обязательный параметр"}), 404
    vectorImg   = [] 
    jsonData    = request.json['data'] 
    for item in jsonData:
        try:
            #Получение кодированного изображения
            base64Image = item['base64img']
            #Декодирование изображения
            imgDecode   = face.decodeBase64(base64Image)
            #Получение вектора лица изображения
            result      = face.getVector(imgDecode)
            #Проверка на существование лица на изображении
            if(result != False):
                vectorImg.append( { 'code': 200, 'vector': str(result) } )
            else:
                vectorImg.append( { 'code': 201, 'msg': 'No face' } )
        except Exception as ex:
            vectorImg.append({'code': 404, 'msg': str(ex)})
    return jsonify({'data': vectorImg}), 200
    

#Поиск совпадений фотографий в БД
@app.route('/api/compare-img', methods=['POST'])
def compare_images():
    if not request.json or not 'data' in request.json :
        return jsonify({'errors': "Не пришел обязательный параметр"}), 404
    jsonData    = request.json['data'] 
    base64Image = jsonData['base64img']
    try:
        arr     = []
        #Декодирование полученного изображения
        decodeReqImg  = face.decodeBase64(base64Image)
        #Получение вектора декадированного изображения
        reqImgVector  = face.getVector(decodeReqImg)
        # if reqImgVector == False :
        #     return jsonify({'code': 201, 'msg': "Лицо не найдено!"}), 200

        result  = db.fetchPacients() 
        for item in result :  # Выборка запроса
            if(item['embedings'] and item['embedings'] != 'No face'):
                #Получения вектора из строки в 
                vectorEmbDB   = [float(s) for s in item['embedings'].split()]
                # Получения Евклидового расстояния 
                result        = face.euclideanPefagora(vectorEmbDB, reqImgVector)
                if(result < 0.6):
                    #arr.append({
                     # 'id': item['id'],
                      #'id_pacient': item['id_pacient'],
                      #'name': item['name'],
                      #'img': item['img'],
                      #'distance': result
                    #})
                    arr2 = {
                         'id': item['id'],
                         'id_pacient': item['id_pacient'],
                         'name': item['name'],
                         'img': item['img'],
                         'distance': result
                    }
                    return jsonify({'code': 200, 'data': arr2}), 200
                #end if
            #end if
        #end for 
        return jsonify({'code': 201, 'data': arr}), 200
    except Exception as ex:
        return jsonify({'code': 404, 'msg': ex}), 404

@app.errorhandler(404)
def page_not_found(error):
    return jsonify({'errors': str(error)})

if __name__ == "__main__":
    app.run()
