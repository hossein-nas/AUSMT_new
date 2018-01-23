import {Comment} from './modules/Comment'
import {Alert} from './modules/Alert';

(function () {
    var elem = $('.cpanel-comment-area')


    // terminating if elem not present
    if (!elem.length)
        return;

    /*
    * Adding show modal event
    * */
    $('.cpanel-comment-area .management-section .item .more-detail').on('click', function () {
        (new Comment( $(this).closest('.item') )).showDetailModal();
    })

    /*
    * Adding verification button event
    * */
    $('.verification').click(function () {
        var cm_id = $(this).closest('.item').data('cm-id');
        $.post('/panel/comment/' + cm_id + '/verify', function (e, d) {
            window.location.reload(true);
        })
    })


    /*$.ajax('https://reqres.in/api/users?page=2', {
        method: "GET",
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            console.log(xhr);
            //Upload progress
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    //Do something with upload progress
                    console.log(percentComplete);
                }
            }, false);
            //Download progress
            xhr.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    //Do something with download progress
                    console.log(percentComplete);
                }
            }, false);
            return xhr;
        },
        success: function (res) {
            console.log(res);
        }
    });*/

})();
