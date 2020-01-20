import dlib
import numpy as np
import cv2
import random
#from scipy.spatial import distance
import base64

class Face:

    def __init__(self):
        self.sp          = dlib.shape_predictor('./data/shape_predictor_68_face_landmarks.dat')
        self.facerec     = dlib.face_recognition_model_v1('./data/dlib_face_recognition_resnet_model_v1.dat')
        self.detector    = dlib.get_frontal_face_detector()  # эта часть обнаруживает наше лицо

    # Получение вектора лица
    def getVector(self, image) :
        try :
            dets = self.detector(image, 1)
            shape = None
            for k, d in enumerate(dets) :
                shape = self.sp(image, d)
            #end for
            return self.facerec.compute_face_descriptor(image, shape)
        except Exception as ex :
            return False
            
    # Получение лица на изображении
    def cv2Haar(self, image, local = 0):
        rand = random.randint(1, 10)

        face_cascade = cv2.CascadeClassifier('./data/haarcascade_frontalface_default.xml')
        eye_cascade = cv2.CascadeClassifier('./data/haarcascade_eye.xml')

        if(local > 0):
            img = cv2.imread(image)
        else :
            img = image
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        faces = face_cascade.detectMultiScale(gray, 1.3, 5)
        for (x,y,w,h) in faces:
            img = cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)
            roi_gray = gray[y:y+h, x:x+w]
            roi_color = img[y:y+h, x:x+w]
        #end for
        return img

    #Кодирование изображения в base64
    def encodeBase64(slef, img):
        base64_data = ''
        with open(img,"rb") as f:
            base64_data = base64.b64encode(f.read())
        return base64_data

    #Проверка на кодирование
    def isBase64(s):
        try:
            return base64.b64encode(base64.b64decode(s)) == s
        except Exception:
            return False

    #Декодирование изображения из base64
    def decodeBase64(self, imgCode):
        imgData = base64.b64decode(imgCode)
        nparr   = np.fromstring(imgData, np.uint8)
        img_np  = cv2.imdecode(nparr, cv2.IMREAD_COLOR)
        return img_np

    # Определение евклида формулой Пефагора 
    def euclideanPefagora(self, vx, vy) :
        x = np.array(vx)
        y = np.array(vy)
        return np.sqrt( np.sum( (x - y)**2 ))

    # Определение евклида формулой библиотеки dLib
    def euclideanDistance(self, vect1, vect2) :
        return None #distance.euclidean(vect1, vect2)
