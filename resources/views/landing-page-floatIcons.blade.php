<div class="fixed-icons">
  <ul>
    <li id="wsp"><a href="https://api.whatsapp.com/send?phone=56977088874&text=Habla%20con%20nosotros!" target="_blank"><img src="{{asset('images/icons/whatsapp_logo.png')}}" alt=""></a></li>
    <li class="d-none"><a href="#"><i class="fa fa-calendar"></i></a></li>
  </ul>
</div>

<style>
  #wsp{
    background-image:
  }
  .fixed-icons {
  position: fixed;
  bottom: 0;
  right: 0;
}

.fixed-icons ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.fixed-icons li {
  display: inline-block;
  margin: 0 5px;

  padding:10px;
}
.fixed-icons img {
  display: inline-block;
  align-items: center;
  justify-content: center;
}
.fixed-icons li a {
  display: block;
  width: 100px;
  height: 100px;
  text-align: center;
  line-height: 40px;
  border-radius: 50%;
  color: #fff;
  background: #333;
  font-size: 20px;
  transition: all 0.3s ease;

  padding: 30px;
}

.fixed-icons li a:hover {
  background: #666;
}

</style>