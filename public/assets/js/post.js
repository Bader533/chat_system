function buttonSideBar() {
    const button = document.getElementById('articles');
    button.classList.add('here', 'show');
}

function getPost(page = 1, query = null) {
    axios.get('/getPost', {
        params: {
            page: page,
            query: query,
        }
    })
        .then(function (response) {
            $('#table_content').html(response.data);
        }).catch(function (error) {
            console.error('There was an error!', error);
        });
} // get all posts

document.getElementById('search_data').addEventListener('input', function () {
    const searchQuery = this.value;
    if (searchQuery) {
        console.log('data');
        getPost(1, searchQuery);
    } else {
        console.log('empty');
        getPost();
    }
}); // live search

function confirmDelete(id, reference) {
    Swal.fire({
        title: site.are_you_sure,
        text: site.you_won_be_able_to_revert_this,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: site.cancel,
        confirmButtonText: site.yes_delete_it
    }).then((result) => {
        if (result.isConfirmed) {
            performDelete(id, reference);
        }
    });
} //end message confirm delete

function performDelete(id, reference) {
    axios.delete('/post/' + id)
        .then(function (response) {
            //2xx
            console.log(response);
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.success(response.data.message);
            getPost();
        })
        .catch(function (error) {
            //4xx - 5xx
            console.log(error.response.data.message);
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.error(error.response.data.message);
        });
} //end detete

function changeStatus(itemId) {
    axios.get('/status/post', {
        params: {
            id: itemId
        }
    })
        .then(function (response) {
            console.log(response.data.message);
        }).catch(function (error) {
            console.error('There was an error!', error);
        });
} // change post status
