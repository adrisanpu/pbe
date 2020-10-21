from lib.pirc522 import RFID
import RPi.GPIO as GPIO

class Rfid:
    
    def read_uid(self):        
        self.wait_for_tag()
        (error, data) = self.request()
        if not error:
            (error, card_uid) = self.anticoll()
            uidhex = str(hex(card_uid[0]))+","+str(hex(card_uid[1]))+","+str(hex(card_uid[2]))+","+str(hex(card_uid[3]))                
        return uidhex
                               
    if __name__ == "__main__":
        GPIO.setwarnings(False)
        print("READING...")
        rf = RFID()
        uid = read_uid(rf)       
        print(uid)
