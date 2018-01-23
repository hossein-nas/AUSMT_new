import {Modal} from './Modal';

export class Comment {
    constructor(elem) {
        var dataAttr = elem.data('cm-data');
        if (dataAttr === undefined)
            return false;
        this.data = dataAttr
        this.data.dates = ['created_at', 'updated_at', 'verified_at'];
        this.convertDates();
    }

    showDetailModal() {
        var options = {
            modalClassName : 'ui modal small',
            modalHeaderText: 'جزئیات دیدگاه ' + this.data.name,
            modalFooterButtons: [
                {
                    className: 'ui button mini approve green',
                    text: 'بستن'
                }
            ],
            modalBodyText: this.generatingModalBodyText(),
        }
        this.modal = new Modal(options);
        this.modal.show();
    }

    generatingModalBodyText() {
        var ret = `
            <div class="cm-table" data-cm-id="${this.data.id}">
                <div class="name">${this.data.name}</div>
                <div class="email">${this.data.email}</div>
                <div class="content">${this.data.content}</div>
                <div class="ip">${this.data.ip}</div>
                <div class="verified">${this.data.verified ? 'بلی' : 'خیر'}</div>
                <div class="created_at">${this.data.persian_date.created_at}</div>
                <section class="events">
                    <div class="ui icon buttons compact fluid">
                        <button class="ui button red delete-cm" title="حذف دیدگاه"> <i class="remove icon"></i> </button>
                        <button class="ui button edit-cm" title="ویرایش دیدگاه"> <i class="write icon"></i> </button>
                        <a class="ui button view-cm" title="مشاهده دیدگاه" href="${ this.data.postUrl + '#cm-' + this.data.id}" target="_blank"> <i class="linkify icon"></i> </a>
                        <button class="ui button reply-cm" title="ارسال پاسخ به این دیدگاه"> <i class="reply icon"></i> </button>
                    </div>
                </section>
            </div>
        `
        ret = $(ret);
        /*
        * Checking for comment is verified or not
        * */
        if ( this.data.verified == 0 ){
            var verify = $(`<button class="ui button teal verify-cm" title="تأیید دیدگاه"> <i class="checkmark icon"></i> </button>`)
            verify.on('click', {_this: this}, this.verifyComment);
            ret.find('.events>div').prepend(verify);
        }

        if ( this.data.verified == 1 ){
            // Adding verified_at row to modal
            var verified_at = $(`<div class="verified_at">${this.data.persian_date.verified_at}</div>`)
            ret.find('.verified').after( verified_at );
        }



        ret.find('.delete-cm').on('click', this.deleteComment);
        ret.find('.edit-cm').bind('click', {_this: this}, this.editComment);
        ret.find('.reply-cm').bind('click', {_this: this}, this.replyCommentAsAdmin);
        return ret;
    }

    convertTimeToPersian(date) {
        var timestamp = new Date(date).getTime();
        return (new persianDate(new Date(timestamp).getTime())).format('YY/MM/DD HH:mm:ss')
    }

    convertDates() {
        var _this = this;
        _this.data.persian_date = [];
        this.data.dates.forEach(function (date) {
            _this.data.persian_date[date] = _this.convertTimeToPersian(_this.data[date]);
        })
    }

    deleteComment(event) {
        var cm_id = $(this).closest('.cm-table').data('cm-id');
        $.post('/panel/comment/' + cm_id + '/delete', function (res, status) {
            console.log(status, res);
            if (status == 'success') {
                alert('دیدگاه با موفقیت حذف شد.')
                setTimeout(function () {
                    window.location.reload(true);
                }, 1000)
            }
        })
    }

    editComment(event) {
        var _this = event.data._this;
        _this.modal.hide(function () {
            var options = {
                modalHeaderText: 'ویرایش دیدگاه : ' + _this.data.name,
                modalFooterButtons: [
                    {
                        className: 'ui button tiny cancel',
                        text: 'بستن'
                    },
                    {
                        className: 'ui button tiny teal approve',
                        text: 'ثبت تغییرات'
                    }
                ],
                modalBodyText: 'Textarea',
                modalBodyText: $(`
                    <form class="ui form small"> 
                        <div class="two fields"> 
                            <div class="field required">
                              <label>نام کاربر </label>
                              <input type="text" name="username" id='editForm-name' value="${ _this.data.name }">
                            </div>
                            <div class="field required">
                              <label>ایمیل کاربر </label>
                              <input type="email" name="email" id='editForm-email' value="${ _this.data.email }">
                            </div>
                        </div>
                        <div class="field required">
                            <label>متن دیدگاه</label>
                            <textarea rows="4" name='content' id='editForm-content' >${ _this.data.content }</textarea>
                        </div>
                    </form>
                `)
            }
            _this.editModal = new Modal(options);
            _this.editModal.setSetting({
                onApprove: function (a, b) {
                    var _form = $(this).find('.ui.form');
                    var data = new FormData();
                    var fields = ['name', 'email', 'content']
                    var count = 0;
                    fields.forEach(function (item) {
                        var val = _form.find('#editForm-' + item).val();
                        if (_this.data[item] !== val) {
                            data.append(item, val);
                            count++;
                        }
                    })
                    $.ajax('/panel/comment/' + _this.data.id + '/update', {
                        data: data,
                        method: "POST",
                        beforeSend: function () {
                            if ( count == 0 ) {
                                alert('تغییری اعمال نشده. درخواست قابل ارسال نیست')
                                return false;
                            }
                        },
                        success: function (res, status) {
                            alert(res.text);
                            setTimeout(function(){
                                _this.editModal.hide(function(){});
                            },500)
                        },
                        error: function (e, d) {
                            alert('خطایی رخ داد');
                            console.log(e);
                            console.log(d);
                        }
                    })
                    return false
                }
            })
            _this.editModal.show();
        })
    }

    replyCommentAsAdmin(event) {
        var _this = event.data._this
        _this.modal.hide(function () {
            var options = {
                modalHeaderText: 'ارسال پاسخ به دیدگاه : ' + _this.data.name,
                modalFooterButtons: [
                    {
                        className: 'ui button tiny cancel',
                        text: 'بستن'
                    },
                    {
                        className: 'ui button tiny teal approve',
                        text: 'ثبت دیدگاه'
                    }
                ],
                modalBodyText: 'ok'
            }
            _this.replyModal = new Modal(options);
            _this.replyModal.show();
        });
    }

    verifyComment(event){
        var _this = event.data._this;
        $.post('/panel/comment/'+_this.data.id +'/verify', function(res,status){
            if ( status == 'success'){
                alert('با موفقیت انجام شد.')
                window.location.reload(true);
            }
        })
    }
}