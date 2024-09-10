function buttonSideBar() {
    const button = document.getElementById('users');
    button.classList.add('active', 'show');
}

function showFollowers() {
    getData('followers', 1, null, '#table-content-followers');
}

function showFollowing() {
    getData('following', 1, null, '#table-content-following');
}

function showWallets() {
    getData('wallets', 1, null, '#table-content-wallets');
}

function showRooms() {
    getData('rooms', 1, null, '#table-content-rooms');
}

function getData(type, page = 1, query = null, place) {
    axios.get('/getdata', {
        params: {
            type: type,
            page: page,
            query: query,
            user_id: userId,
        }
    })
        .then(function (response) {
            $(place).html(response.data);
        })
        .catch(function (error) {
            console.error('There was an error!', error);
        });
}

function changeStatus(itemId) {
    axios.get('/status/user', {
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

function changeRoomStatus(itemId) {
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
