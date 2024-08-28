function buttonSideBar() {
    const button = document.getElementById('room');
    button.classList.add('here', 'show');
}

function getRooms(page = 1, query = null) {
    axios.get('/getRoom', {
        params: {
            page: page,
            query: query,
            kind: data,
        }
    })
        .then(function (response) {
            $('#table_content').html(response.data);
        }).catch(function (error) {
            console.error('There was an error!', error);
        });
}

document.getElementById('search_data').addEventListener('input', function () {
    const searchQuery = this.value;
    if (searchQuery) {
        console.log('data');
        getRooms(1, searchQuery);
    } else {
        console.log('empty');
        getRooms();
    }
});

function changeStatus(itemId) {
    axios.get('/status/room', {
        params: {
            id: itemId
        }
    })
        .then(function (response) {
            console.log(response.data.message);
        }).catch(function (error) {
            console.error('There was an error!', error);
        });
}

function changeIsHome(itemId) {
    axios.get('/home/room', {
        params: {
            id: itemId
        }
    })
        .then(function (response) {
            console.log(response.data.message);
        }).catch(function (error) {
            console.error('There was an error!', error);
        });
}

function changeIsFavorite(itemId) {
    axios.get('/favorite/room', {
        params: {
            id: itemId
        }
    })
        .then(function (response) {
            console.log(response.data.message);
        }).catch(function (error) {
            console.error('There was an error!', error);
        });
}
