class Notify {
    constructor(message,color,time){
      this.message = message;
      this.color = color;
      this.time = time;
      this.element = null;

        this.create();
        this.show();
    }
    create(){
        var element = document.createElement('div');
        element.className = "notify-notification";
        this.element = element;
        element.style.color = this.color;

        var image = document.createElement('img');
        image.src = `./assets/img/icon-${this.color}.png`;
        image.className = "notify-image";
        element.appendChild(image);

        var text = document.createElement('p');
        text.className = "notify-text";
        text.innerHTML = this.message;
        element.appendChild(text);
    }
    show(){
        this.element.classList.add('show');
        document.body.appendChild(this.element);

        setTimeout(()=>{
            this.element.remove();
        }, this.time + 250)
    }
    
}

class NotificationHandler {
    constructor() {
        this.activeNotifications = [];
    }
    addNotification(notification) {
        this.activeNotifications.push(notification);
    }
    getNotifications() {
        return this.activeNotifications;
    }
    sucess(message) {
        var notify = new Notify(message, 'green', 3500);
        this.addNotification(notify)
    }
    error(message) {
        var notify = new Notify(message, 'red', 3500);
        this.addNotification(notify)
    }
    warning(message) {
        var notify = new Notify(message, 'yellow', 3500);
        this.addNotification(notify)
    }
    info(message) {
        var notify = new Notify(message, 'blue', 3500);
        this.addNotification(notify)
    }
}
const Nosifier = new NotificationHandler();
