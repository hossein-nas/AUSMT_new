export class Alert {
    constructor() {

        if ( this.alreadyInitiated() )
            return null;
        else {
            this.data = [];
            this.initiatingAlertElem();
            return this;
        }

    }

    initiatingAlertElem() {
        this.data['box'] = this.initiatingAlertBox();
    }

    alreadyInitiated(){
        if ( $('#alert-box').length > 0 )
            return true;
        else
            return false;
    }

    initiatingAlertBox() {

        var alertsBody = $('<div id="alert-box"> </div>')
        $('body').append(alertsBody);
        return alertsBody;
    }

    newAlert(text, options) {
        var opt = $.extend({}, {
            timeout: 5000,
            header: null,
            closable: false,
            type: 'default',
            before:function(){},
            after:function(){},
            autoClose:false,

        }, options);
    }

    createNewAlert(text, options) {
        this.data.box.append('<div class="alert-box-item"><span class="close"></span>'+text+'</div>');
    }
}