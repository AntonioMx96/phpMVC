let deleteCategory = id => {
        
    fetch("<?= route('category/') ?>" + id, {
      method: "delete",
      headers: {
        'Content-Type': 'application/json'
      }
    })
      .then(respose => respose.json())
      .then(data => {
        console.log(data)
        location.reload();
      })

  }