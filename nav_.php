<head>
	<link rel="icon" href="http://hfyyl2.mercury.nottingham.edu.my/css/globe.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
.page-header {
  display: -webkit-box;
  display: flex;
  flex-wrap: wrap;
  -webkit-box-pack: justify;
          justify-content: space-between;
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  overflow: visible;
  padding: 1rem;
  z-index: 200;
}

nav {
  display: -webkit-box;
  display: flex;
  position: absolute;
  top: 0;
  left: 0;
  padding: 3rem 1rem 1rem;
  width: 100vw;
  min-height: 100vh;
  text-align: center;
  background-color: #12343B;        /*----                                        ---*/
  opacity: 0;
  -webkit-transform: translateY(-100%);
          transform: translateY(-100%);
  -webkit-transition: opacity 0.45s 0.45s ease, -webkit-transform 0s 1.2s;
  transition: opacity 0.45s 0.45s ease, -webkit-transform 0s 1.2s;
  transition: opacity 0.45s 0.45s ease, transform 0s 1.2s;
  transition: opacity 0.45s 0.45s ease, transform 0s 1.2s, -webkit-transform 0s 1.2s;
  border-right: solid 50px #12343B;     /*----                                        ---*/
}

.menu .sub-menu {
  padding: 0;
  grid-template-columns: repeat(2, 1fr);
}
@media (min-width: 500px) {
  .menu .sub-menu {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (min-width: 450px) {
  .menu .sub-menu li a {
    font-size: 1rem;
  }
}

@media (min-width: 500px) {
  .menu .sub-menu li:nth-child(3n) {
    grid-column: span 1;
  }
}

.menu-toggle {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  grid-gap: 2px;
  position: relative;
  cursor: pointer;
  width: 28px;
  height: 22px;
  z-index: 100;
}
.menu-toggle:before {
  content: "×";
  position: absolute;
  top: 0;
  left: 0;
  font-size: 5rem;
  line-height: 0.4;
  color: #FFFFFF;
  z-index: 2;
  opacity: 0;
  -webkit-transition: opacity 0.3s ease;
  transition: opacity 0.3s ease;
}
.menu-toggle span {
  display: block;
  position: relative;
  width: 100%;
  height: 2px;
  background-color: #FFFFFF;
  border-radius: 2px;
  -webkit-transition: -webkit-transform 0.3s ease;
  transition: -webkit-transform 0.3s ease;
  transition: transform 0.3s ease;
  transition: transform 0.3s ease, -webkit-transform 0.3s ease;
  -webkit-transform-origin: 100% 100%;
          transform-origin: 100% 100%;
}
.menu-toggle span:nth-child(1) {
  -webkit-transition-delay: 0.35s;
          transition-delay: 0.35s;
}
.menu-toggle span:nth-child(2) {
  -webkit-transition-delay: 0.4s;
          transition-delay: 0.4s;
}
.menu-toggle span:nth-child(3) {
  -webkit-transition-delay: 0.45s;
          transition-delay: 0.45s;
}
.menu-toggle span:nth-child(4) {
  -webkit-transition-delay: 0.5s;
          transition-delay: 0.5s;
}
.menu-toggle span:nth-child(5) {
  -webkit-transition-delay: 0.55s;
          transition-delay: 0.55s;
}
.menu-toggle span:nth-child(6) {
  -webkit-transition-delay: 0.6s;
          transition-delay: 0.6s;
}
.menu-toggle span:nth-child(1), .menu-toggle span:nth-child(2) {
  grid-column: span 3;
}
.menu-toggle span:nth-child(3), .menu-toggle span:nth-child(6) {
  grid-column: span 2;
}
.menu-toggle span:nth-child(4), .menu-toggle span:nth-child(5) {
  grid-column: span 4;
}

#menu-toggle-input {
  display: none;
}
#menu-toggle-input:checked ~ .menu-toggle span {
  -webkit-transform: scaleX(0);
          transform: scaleX(0);
}
#menu-toggle-input:checked ~ .menu-toggle span:nth-child(1) {
  -webkit-transition-delay: 0.05s;
          transition-delay: 0.05s;
}
#menu-toggle-input:checked ~ .menu-toggle span:nth-child(2) {
  -webkit-transition-delay: 0.1s;
          transition-delay: 0.1s;
          
}
#menu-toggle-input:checked ~ .menu-toggle span:nth-child(3) {
  -webkit-transition-delay: 0.15s;
          transition-delay: 0.15s;
}
#menu-toggle-input:checked ~ .menu-toggle span:nth-child(4) {
  -webkit-transition-delay: 0.2s;
          transition-delay: 0.2s;
}
#menu-toggle-input:checked ~ .menu-toggle span:nth-child(5) {
  -webkit-transition-delay: 0.25s;
          transition-delay: 0.25s;
}
#menu-toggle-input:checked ~ .menu-toggle span:nth-child(6) {
  -webkit-transition-delay: 0.3s;
          transition-delay: 0.3s;
}
#menu-toggle-input:checked ~ .menu-toggle:before {
  opacity: 1;
  -webkit-transition-delay: 0.75s;
          transition-delay: 0.75s;
}
#menu-toggle-input:checked ~ nav {
  background-color: #12343B ; /*----                                        ---*/
  opacity: 0.95;

  -webkit-transform: translateY(0);
          transform: translateY(0);
  -webkit-transition-delay: 0s;
          transition-delay: 0s;
}

            .nav_a:hover {
                font-family: GROBOLD;
                color:  #de9ea9;
                -webkit-text-stroke-width: 2px;
                -webkit-text-stroke-color: #331F22;
                text-decoration: none;
            }

            .nav_a{
                font-family: GROBOLD;
                color:#FFFFFF;
                -webkit-text-stroke-width: 2px;
                -webkit-text-stroke-color: black;
                text-decoration: none;
            }
            

            


            .globe{
                height: 550px;
                width: auto;
                display: block;
                margin: 0 auto;
            }

            .wording{
                font-size: 100px;
                height: 80%;
                margin: 10%;
            }
            .wording:hover{
                color:  #f2eb00;
            }

            .carousel-control.left, .carousel-control.right{
                background-image: none;
                filter: none;
                width: 10vw;
            }

            .wide{
                width: 80vw;
                height: 60vh;
                text-align: center;
                vertical-align: middle;
                margin:20vh auto;
                background-image: url(https://hfyyl2.mercury.nottingham.edu.my/css/globe.png);
                background-size:auto 100%;
                background-repeat: no-repeat;
                background-position: center;
            }

            .item{
                text-align: center;
                vertical-align: middle;
                height: 100%;
                text-align: center;
            }

            .carousel-inner{
                height: 80%;
                margin: 5% auto;
            }

            .x{
                border:1px solid transparent;
                height: 100%;
            }
            @media only screen and (min-width: 600px) {
                .wide{
                width: 80vw;
                height: 60vh;
                text-align: center;
                vertical-align: middle;
                margin:20vh auto;
                background-image: url(https://hfyyl2.mercury.nottingham.edu.my/css/globe.png);
                background-size:70% auto;
                background-repeat: no-repeat;
                background-position: center;
            }
            a.nav_a{
                font-size:0.7em;
            
            }
            a.nav_a:hover{
            
              font-size: 0.7em;
            }
            }
            @media only screen and (min-width: 768px) {
                .wide{
                width: 80vw;
                height: 60vh;
                text-align: center;
                vertical-align: middle;
                margin:20vh auto;
                background-image: url(https://hfyyl2.mercury.nottingham.edu.my/css/globe.png);
                background-size:auto 100%;
                background-repeat: no-repeat;
                background-position: center;
            }
                        a.nav_a{
                font-size:1.25em;
            
            }
                        a.nav_a:hover{
            
              font-size: 1.25em;
            }
            }
            @media screen and (max-width: 479px) {
                .wide{
                width: 80vw;
                height: 60vh;
                text-align: center;
                vertical-align: middle;
                margin:20vh auto;
                background-image: url(https://hfyyl2.mercury.nottingham.edu.my/css/globe.png);
                background-size:80% auto;
                background-repeat: no-repeat;
                background-position: center;
            }
            a.nav_a{
                font-size:0.7em;
            
            }
            a.nav_a:hover{
            
              font-size: 0.7em;
            }
            }


</style>
<header class="page-header" style="margin:0;border-bottom:0px;padding:30px;">
	<input id="menu-toggle-input" type="checkbox" />
	<label class="menu-toggle" for="menu-toggle-input">
	  <span></span>
	  <span></span>
	  <span></span>
	  <span></span>
	  <span></span>
	  <span></span>
	</label>
	<nav class="menu">
                    <div class="wide">
                <div id= "myCarousel" class="carousel slide x" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                                <div class = "wording"><title>Home</title>
                                    <p><br><a class="nav_a" href= "https://www.hfyyl2.mercury.nottingham.edu.my/world_website.html">Home</a></p>
                                </div>
                        </div>
                        <div class="item">
                                <div class = "wording" ><title>General Info</title>
                                    <p><br><a class="nav_a" href= "http://hfyyl2.mercury.nottingham.edu.my/Select/Select_General_Information.php">General Info</a></p>
                                </div>
                        </div>
                        <div class="item">
                                <div class = "wording"><title>Geographical</title>
                                    <p><br><a class="nav_a" href= "http://hfyyl2.mercury.nottingham.edu.my/Select/Select_Geographical_Information.php">Geographical</a></p>
                                </div>
                        </div>
                        <div class="item">
                                <div class = "wording"><title>Language</title>
                                    <p><br><a class="nav_a" href= "http://hfyyl2.mercury.nottingham.edu.my/Select/Select_Country_Language.php">Language</a></p>
                                </div>
                        </div>
                        <div class="item">
                                <div class = "wording"><title>Population</title>
                                    <p><br><a class="nav_a" href= "http://hfyyl2.mercury.nottingham.edu.my/Select/Select_Population.php">Population</a></p>
                                </div>
                        </div>
                        <div class="item">
                                <div class = "wording"><title>Region</title>
                                    <p><br><a class="nav_a" href= "http://hfyyl2.mercury.nottingham.edu.my/Select/Select_Country_Region.php">Region</a></p>
                                </div>
                        </div>
                        <div class="item">
                                <div class = "wording"><title>City</title>
                                    <p><br><a class="nav_a" href= "http://hfyyl2.mercury.nottingham.edu.my/Select/Select_City.php">City</a></p>
                                </div>
                        </div>
                        <div class="item">
                                <div class = "wording"><title>Country</title>
                                    <p><br><a class="nav_a" href= "http://hfyyl2.mercury.nottingham.edu.my/Select/Select_Country_Name.php">Country</a></p>
                                </div>
                        </div>
                        <div class="item">
                                <div class = "wording"><title>District</title>
                                    <p><br><a class="nav_a" href= "http://hfyyl2.mercury.nottingham.edu.my/Select/Select_Country_District.php">District</a></p>
                                </div>
                        </div>
                        <div class="item">
                                <div class = "wording"><title>Economic</title>
                                    <p><br><a class="nav_a" href= "http://hfyyl2.mercury.nottingham.edu.my/Select/Select_Economic_Status.php">Economic</a></p>
                                </div>
                        </div>
                    </div>

                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
	</nav>
  </header>