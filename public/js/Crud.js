class Crud {
    get(url) {
        return new Promise(resolve => {
            return resolve(
                fetch(url, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(respose => respose.json())
                    .then(data => {
                        return data.data
                    })
            )
        })
    }

    store(url, method,  data) {
        return new Promise(resolve => {
            return resolve(
                fetch(url, {
                    method: method,
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(respose => respose.json())
                    .then(data => {
                        return data
                    })
            )
        })
    }
}