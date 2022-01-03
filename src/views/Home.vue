<template>
  <div class="home">
   <navBar />
    <section style='background-image: url(https://raw.githubusercontent.com/raed-charrad/ProjetDesign/main/bc.jpg); '>
        <div class="container">
            <div class="row">
              <div class="intro-info  col-lg-6" style=" margin: 200px auto">
                <h1 style="color: #0A2E51 ">Système De Management Des Etudiants</h1>
                <div style="color: #0A2E51; font-size: large; margin: 0px 0px 5px !important;">
                  <p> Laudem latine persequeris id sed, ex fabulas delectus quo. No vel partiendo abhorreant vituperatoribus.</p>
                </div>
                <button type="button" class="btn btn-primary px-5" style="margin:50px">Sign up</button>
              </div>
              <div class="col-lg-6 mx-auto">
                  <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_q3ldphok.json" background="transparent"  speed="1"   loop  autoplay></lottie-player>
              </div>
            </div>
          </div>
      </section>
    <section id="services" class="section-bg " style="justify-content: space-between">
      <div class="container">

        

        <div class="row">
        <header class="col-md-6 col-lg-5 offset-lg-1 " style="color:white;">
          <h2>Fonctionnalité</h2>
          <p style=" font-size: large; margin: 0px 0px 5px !important;">Laudem latine persequeris id sed, ex fabulas delectus quo. No vel partiendo abhorreant vituperatoribus.</p>
        </header>
          <div class="col-md-6 col-lg-5 offset-lg-1" >
            <div class="box">
              <div class="icon"><img src="../assets/security.png" style="width:20%" alt="" srcset=""></div>
              <h4 class="title"><a href="">Sécurité Extreme</a></h4>
              <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 offset-lg-1" >
            <div class="box">
              <div class="icon"><img src="../assets/dashboard.png" style="width:20%" alt="" srcset=""></div>
              <h4 class="title"><a href="">Intuitive Dashboard</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 offset-lg-1" >
            <div class="box">
              <div class="icon"><img src="../assets/performance.png" style="width:20%" alt="" srcset=""></div>
              <h4 class="title"><a href="">Performance</a></h4>
              <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
            </div>
          </div>

          
          <div class="col-md-6 col-lg-5 offset-lg-1" >
            <div class="box">
              <div class="icon"><img src="../assets/communication.png" style="width:20%" alt="" srcset=""></div>
              <h4 class="title"><a href="">Communication</a></h4>
              <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-5 offset-lg-1" >
            <div class="box">
              <div class="icon"><img src="../assets/simplicity.png" style="width:20%" alt="" srcset=""></div>
              <h4 class="title"><a href="">Simplicité</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>
          </div>
          

        </div>

      </div>
    </section>
    <section style="background-image: url(https://raw.githubusercontent.com/raed-charrad/ProjetDesign/main/b1.jpg) ;background-repeat:no-repeat;">
        <div class="container">
          <div class="row">
            <div class="col-md-6" style=" margin: 200px auto">
              <img src="../assets/cptr.jpg" alt="" srcset="" class="img-fluid">
            </div>
            <div class="col-md-6" style=" margin: 200px auto">
              <h1 style="color: #0A2E51 ">Système De Management Des Etudiants</h1>
                <div style="color: #0A2E51; font-size: large; margin: 0px 0px 5px !important;">
                  <p> Laudem latine persequeris id sed, ex fabulas delectus quo. No vel partiendo abhorreant vituperatoribus.</p>
                  <p> Laudem latine persequeris id sed, ex fabulas delectus quo. No vel partiendo abhorreant vituperatoribus.</p>
                </div>
            </div>
          </div>
        </div> 
    </section>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h1 style="color: #0A2E51 "> Panel de professeur</h1>
            <div class="row">
              <div class="col-md-6">
                <ul style="color: #0A2E51 ">
                  <li>CRUD Matière.</li>
                  <li>CRUD Classe.</li>
                  <li>CRUD Etudiant.</li>
                  <li>CRUD Examin.</li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul style="color: #0A2E51 ">
                  <li>CRUD Matière.</li>
                  <li>CRUD Classe.</li>
                  <li>CRUD Etudiant.</li>
                  <li>CRUD Examin.</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <video src="../assets/video.mp4" width=500  height=300 autoplay poster="vignette.jpg"> 
            </video>
          </div>
        </div>
      </div>
    </section>
    <section style="background-color:#0B2F52 ; text-align:center ; color:white;">
        <div class="container p-4" >
          <img src="../assets/logo_Vblanche.png" alt="" srcset="" width=500  height=300 style="margin-top:50px">
        </div>
    </section> 
    </div>
</template>

<script>
// @ is an alias to /src
import "@lottiefiles/lottie-player";
import navBar from "../components/navbar.vue";
export default {
  name: "Home",
  components: {
    navBar,
  },
  created() {
    document.title="Home";
  }

};
</script>
<style>
#services {
  padding: 60px 0 40px 0;
  box-shadow: inset 0px 0px 12px 0px rgba(0, 0, 0, 0.329);
  background-color:#4B70DB
}
#services .box {
  padding: 30px;
  position: relative;
  overflow: hidden;
  border-radius: 10px;
  margin: 0 10px 40px 10px;
  background: #fff;
  box-shadow: 0 10px 29px 0 rgba(0, 0, 0, 0.767);
  transition: all 0.3s ease-in-out;
}
#services .icon {
  position: absolute;
  left: -30px;
  top: calc(50% - 32px);
}

#services .icon i {
  font-size: 64px;
  line-height: 1;
  transition: 0.5s;
}

#services .title {
  color:#0A2E51;
  margin-left: 40px;
  font-weight: 700;
  margin-bottom: 15px;
  font-size: 18px;
}

#services .title a {
  color: #111;
  text-decoration: none;
}

#services .box:hover .title a {
  color: #007bff;
    text-decoration: none;

}

#services .description {
  font-size: 14px;
  margin-left: 40px;
  line-height: 24px;
  margin-bottom: 0;
}
</style>