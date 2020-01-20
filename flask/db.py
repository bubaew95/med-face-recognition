from flask import jsonify
from flaskext.mysql import MySQL
import pymysql

class DB:
    def __init__(self, app):
        self.mysql = MySQL()
        # MySQL configurations
        app.config['MYSQL_DATABASE_USER']       = 'root'
        app.config['MYSQL_DATABASE_PASSWORD']   = '123'
        app.config['MYSQL_DATABASE_DB']         = 'medical'
        app.config['MYSQL_DATABASE_HOST']       = 'mariadb'
        app.config['MYSQL_PORT']                = '3306'
        try :
          self.mysql.init_app(app)
        except Exception as e:
            return e

    def fetch(self):
        conn = self.mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        try: 
            cursor.execute("SELECT * FROM users")
            rows = cursor.fetchall()
            cursor.close() 
            conn.close()
            return rows
        except Exception as e:
            return e 

    #Получаем фотографии пациентов
    def fetchPacients(self):
        conn = self.mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        try:
            cursor.execute( 
              "SELECT pc.name, pi.* FROM pacient_images as pi " +
              "inner join pacients_cart as pc on pi.`id_pacient` = pc.id"
            )
            rows = cursor.fetchall()
            cursor.close()
            conn.close()
            return rows
        except Exception as e:
            return e 

    #Получаем фотографии пациентов
    def pactientId(self, id):
        conn = self.mysql.connect()
        cursor = conn.cursor(pymysql.cursors.DictCursor)
        try:
            cursor.execute( 
              "SELECT * FROM pacients_cart WHERE id = {0}".format(id)
            )
            rows = cursor.fetchone()
            cursor.close()
            conn.close()
            return rows
        except Exception as e:
            return e 