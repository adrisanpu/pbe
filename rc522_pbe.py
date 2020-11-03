from lib.pirc522 import RFID
import RPi.GPIO as GPIO

class Rfid:
    
    def read_uid(self):        
        self.wait_for_tag()
        (error1, data) = self.request()
        error2 = True
        while error2:
            if not error1:
                (error2, card_uid) = self.anticoll()
                if (card_uid != "\0"):
                    uidhex = str(hex(card_uid[0]))+str(hex(card_uid[1]))+str(hex(card_uid[2]))+str(hex(card_uid[3]))
                    uidhex_final = uidhex.replace("0x","").upper()
                    card_uid = "\0"
                    return uidhex_final
                               
    if __name__ == "__main__":
        GPIO.setwarnings(False)
        print("READING...")
        rf = RFID()
        uid = read_uid(rf)       
        print(uid)
