const contenPost = document.getElementById("posts");
const templatePost = document.querySelector('#teamplatePosts').content;
const fragmentPost = document.createDocumentFragment();

const crud = new Crud()

window.addEventListener('load', async ()=>{
    const posts = await crud.get('http://localhost:8080/postUser/1')
    posts.map(post =>{
        addPosts(post)
    })
    contenPost.appendChild(fragmentPost)
})



const addPosts = post => {
    templatePost.querySelector("#posttext").textContent = post.post
    const clone = templatePost.cloneNode(true)
    fragmentPost.appendChild(clone)
}

const publicPost = document.querySelector("#publicPost");

publicPost.addEventListener('click', async () => {
    const postText = document.getElementById("postText").value
    const post = await crud.store('http://localhost:8080/postUser/', 'post', {post: postText, user_id:1})
    addPosts(post.data)
    const ultimo = contenPost.getElementsByClassName("post")[0];
    contenPost.insertBefore(fragmentPost, ultimo)
})