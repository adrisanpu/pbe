from pirc522 import RFID

class Rfid:
    
    def read_uid(self):
        self.wait_for_tag()
        (error, data) = self.request()
        if not error:
            (error, card_uid) = self.anticoll()       
        return card_uid
                        
    if __name__ == "__main__":
        print("READING...")
        rf = RFID()
        uid = read_uid(rf)
        print("UID:" +str(hex(uid[0]))+","+str(hex(uid[1]))+","+str(hex(uid[2]))+","+str(hex(uid[3])) )
