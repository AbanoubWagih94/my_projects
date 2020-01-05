$(document)
    .on('submit', 'form.js-addBook', function (event) {
        event.preventDefault();

        var _form = $(this);

        var data = {
            category: $('#category').val(),
            bookName: $('#bookname').val(),
            book: $('#book').prop('files')[0]
        };

        var form_data = new FormData();
        form_data.append('book', data.book);
        form_data.append('category', data.category);
        form_data.append('bookName', data.bookName);
        console.log(data);
        $.ajax({
            type:'POST',
            url: '/library/ajax/book.php',
            data: form_data,
            dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
            async:true
        })
            .done(function ajaxDone(data) {
                if(data['book']==="done") {
                    $("book_form").hide();
                    location.reload();
                }
            })
            .fail(function ajaxFailed(e) {
                console.log(e);
            })
            .always(function ajaxAlwaysDoThis(data) {
                console.log(data);
            });

        return false;
    });