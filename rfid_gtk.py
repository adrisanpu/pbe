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
        label = Gtk.Label(label="Please, login with your university card.")
        label.set_name("label")
        vbox.pack_start(label, True, True, 0)
        
        #creacio boto
        button = Gtk.Button(label="Clear")
        button.connect("clicked", self.on_button_clicked)
        vbox.pack_start(button, True, True, 0)
        
        #estils que s'utilitzaran al programa (css)
        blue = b"""
                
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
        red = b"""
                
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
        css_provider = Gtk.CssProvider()
        css_provider.load_from_data(blue)
        context = Gtk.StyleContext()
        screen = Gdk.Screen.get_default()
        context.add_provider_for_screen(screen, css_provider, Gtk.STYLE_PROVIDER_PRIORITY_APPLICATION)
        
        #afegim la caixa a la finestra 
        self.add(vbox)
        
        #inicialitzem i començem el thread
        thread = threading.Thread(target= self.uid_func)
        thread.daemon = True
        self.thread_in_use = True
        thread.start()
        
    #funcio que s'executa cada cop que es pitja el boto i reinicia la finestra
    def on_button_clicked(self, widget):
        if (self.thread_in_use == False):
            label.set_text("Please, login with your university card")
            css_provider.load_from_data(blue)
            thread = threading.Thread(target=self.uid_func)
            thread.start()
            self.thread_in_use = True
        
    #funcio que realitza el lector    
    def uid_func(self):
        rf = RFID()
        uid = read_uid(rf)
        label.set_text("UID:"+uid)
        css_provider.load_from_data(red)
        self.thread_in_use = False

if __name__ == "__main__":
    GPIO.setwarnings(False)
    window = myWindow()
    window.connect("destroy", Gtk.main_quit)
    window.show_all()
    Gtk.main()