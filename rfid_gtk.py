import gi
gi.require_version("Gtk", "3.0")
from gi.repository import Gtk
from gi.repository import Gdk
from rc522_pbe import Rfid
from lib.pirc522 import RFID
import RPi.GPIO as GPIO
import threading

class myWindow(Gtk.Window):
    
    #funcio que inicialitza la interficie grafica
    def __init__(self):
        #creacio finestra
        Gtk.Window.__init__(self,title="CARD READER")
        
        #creacio caixa
        vbox = Gtk.Box(orientation=Gtk.Orientation.VERTICAL, spacing=10)
        vbox.set_homogeneous(False)
        
        #creacio etiqueta
        self.label = Gtk.Label(label="Please, login with your university card.")
        self.label.set_name("label")
        vbox.pack_start(self.label, True, True, 0)
        
        #creacio boto
        button = Gtk.Button(label="Clear")
        button.connect("clicked", self.on_button_clicked)
        vbox.pack_start(button, True, True, 0)
        
        #estils que s'utilitzaran al programa (css)
        self.blue = b"""
                
                button{
                    background-color: #E0D4D4;
                    box-shadow:#00000 5px 5px 1px;
                    }
            
                #label{
                  background-color: #3393FF;
                  font: bold 18px Verdana;
                  color:#FFFFFF;
                }
                
            """
        self.red = b"""
                
                button{
                    background-color: #E0D4D4;
                    box-shadow:#00000 5px 5px 1px;
                    }
                #label{
                  background-color: #FA0000;
                  font: bold 18px Verdana;
                  color:#FFFFFF;
                }
                
            """
        
        #carreguem els estils que acabem de crear en el nostre programa
        self.css_provider = Gtk.CssProvider()
        self.css_provider.load_from_data(self.blue)
        context = Gtk.StyleContext()
        screen = Gdk.Screen.get_default()
        context.add_provider_for_screen(screen, self.css_provider, Gtk.STYLE_PROVIDER_PRIORITY_APPLICATION)
        
        #afegim la caixa a la finestra 
        self.add(vbox)
        
        #inicialitzem i començem el thread
        thread = threading.Thread(target= self.uid_func)
        thread.daemon = True
        self.thread_in_use = True
        thread.start()
        
    #funcio que s'executa cada cop que es pitja el boto i reinicia la finestra
    def on_button_clicked(self, widget):
        GPIO.cleanup()
        if (self.thread_in_use == False):
            self.label.set_text("Please, login with your university card")
            self.css_provider.load_from_data(self.blue)
            thread = threading.Thread(target=self.uid_func)
            thread.start()
            self.thread_in_use = True
        
    #funcio que realitza el lector    
    def uid_func(self):
        rf = RFID()
        uid = Rfid.read_uid(rf)
        self.label.set_text("UID:"+uid)
        self.css_provider.load_from_data(self.red)
        self.thread_in_use = False

if __name__ == "__main__":
    GPIO.setwarnings(False)
    window = myWindow()
    window.connect("destroy", Gtk.main_quit)
    window.show_all()
    Gtk.main()