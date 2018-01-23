export class Modal {
    constructor(options) {
        var opt = $.extend({}, {
            modalClassName: 'ui modal tiny',
            modalHeaderText: 'Header for modal',
            modalBodyText: 'Body text',
            modalFooterButtons: [
                {
                    className: 'ui button mini cancel',
                    text: 'Cancel',
                },
                {
                    className: 'ui button mini approve',
                    text: 'Approve'
                }
            ],
            options : { }
        }, options)
        this.data = opt;

        this.initiatingModal();
        return this;
    }

    initiatingModal() {
        this.modalElem = `
            <div class="${ this.data.modalClassName }">
                <i class="close icon"></i>
                <div class="header"> ${ this.data.modalHeaderText } </div>
                <div class="content"></div>
                <div class="actions"> 
                    ${ this.initiatingFooterButtons() }
                </div>
            </div>
        `
        this.$elem = $(this.modalElem);
        this.initiatingBodyText();

        this.$elem.modal( this.setting( this.data.options ) );
    }

    show(){
        this.$elem.modal('show');
    }

    hide(callback){
        var old_callback = this.data.options.onHidden;
        this.$elem.modal({
            onHidden: function(){ callback(); old_callback(); }
        })
        this.$elem.modal('hide');
    }

    setting(setting){
        var _this = this;
        var ret = $.extend({},{
            onHidden : function(){},
            onHide : function(){},
            onShow : function(){},
            onVisible : function(){},
            onDeny : function(){},
            onApprove : function(){},
            allowMultiple: false,
            observeChanges: true,
            autofocus: false,
            closable : false,
            duration: 225,
            transition: 'fade down'
        },setting);

        if (ret.allowMultiple == false ){
            ret.onHidden = function(){
                _this.$elem.detach();
            }
        }

        this.data.options = ret;
        return ret;
    }

    setSetting(setting){
        this.$elem.modal( this.setting(setting) );
    }
    initiatingFooterButtons() {
        var tmp = '';
        this.data.modalFooterButtons.forEach(function (elem) {
            tmp += `<button class="${elem.className}"> ${elem.text} </button>\n`
        })
        return tmp;
    }

    initiatingBodyText() {
        if (this.data.modalBodyText instanceof jQuery)
            this.$elem.find('.content').append(this.data.modalBodyText);
        else
            this.$elem.find('.content').html(this.data.modalBodyText);
    }


}