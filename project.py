import mysql.connector

class Traffic:
    def __init__(self):
        self.mydb = mysql.connector.connect(
          host="localhost",
          user="root",
          password="",
          database="traffic")
    
    def getAllUsers(self):
        mycursor = self.mydb.cursor()
        sql = "select * from users"
        mycursor.execute(sql)
        res = mycursor.fetchall()
        for ele in res:
            print(ele)
            
    def getAllVictims(self):
        mycursor = self.mydb.cursor()
        sql = "select * from victim"
        mycursor.execute(sql)
        res = mycursor.fetchall()
        for ele in res:
            print(ele)

    def insertTOVictim(self, num_plate):
        mycursor = self.mydb.cursor()
        sql = "INSERT INTO victim (num_plate) VALUES (%s)"
        val = (num_plate,)
        mycursor.execute(sql, val)
        self.mydb.commit()

            
        
obj = Traffic()
obj.getAllUsers()
obj.getAllVictims()




