
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

// Vue.component('example', require('./components/Example.vue'));
//
// const app = new Vue({
//     el: '#app'
// });

$(function () {
    $('.delete').click(function () {
        var id = $(this).attr('data-id');
        var url = $(this).attr('data-url');

        swal({
            title: 'Are you sure?',
            text: "This is irreversible and will be logged.",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(function () {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'delete',
                url: '/ajax' + url,
                dataType: 'json',
                data: {
                    'id' : id
                },
                success : function (data) {
                    if (data.status == 'ok') {
                        swal(
                            'Deleted!',
                            'Entry has been successfully deleted.',
                            'success'
                        ).then(function () {
                            // Reload page after successfully adding team manager
                            location.reload();
                        })
                    } else {
                        swal(
                            'Error!',
                            'Something went wrong',
                            'error'
                        );
                    }
                }
            });
        }, function (dismiss) {
            console.log(dismiss);
        });
    });

});