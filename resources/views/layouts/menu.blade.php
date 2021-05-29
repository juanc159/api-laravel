<nav class="menu">
    <img src="{{ asset('img/api.png') }}" alt="" class="logo"> 
    <div class="menu_list">
        <a class="menu_items" href="/">HOME</a>
        <a class="menu_items" href="{{route('imagenes.index')}}">IMAGENES</a>
        <a class="menu_items" href="{{route('post.index')}}">POST</a>
    </div>
</nav>

<style>

.menu{
    background: rgba(0, 0, 0, .8);
    display: flex;
    padding: 10px 70px;
    justify-content: space-between;

}
.logo{
    color: red;
    width: 20px;
}

.menu_list{
    display: flex;
    justify-content: space-between;
    width: 30%;
}


.menu_items{
    color: #ccc;
    padding: 10px;
    
}

.menu_items:hover{
    color: #ccc;
    text-decoration: none;
    border: 1px solid #ccc;
    border-radius: 5px;
}


</style>