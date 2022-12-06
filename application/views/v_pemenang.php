<div id="row">
  <div id="col" class="text-center">
    <img src="<?= base_url('assets/img/trophy.png') ?>" id="img">

    <br><br>

    <?php if($pemenang['id_pemain'] == $this->session->userdata('id_pemain')) : ?>
      <h1 id="menang"><b>Selamat!</b></h1>
      <h3>Anda telah memenangkan pertandingan</h3>
    <?php else : ?>
      <h1 id="kalah"><b>Mohon maaf, Anda kalah!</b></h1>
      <h3>Pemenangnya adalah <?= $pemenang['nama_pemain'] ?></h3>
    <?php endif ?>

    <br><br>

    <a href="<?= base_url() ?>" type="button" class="btn" id="main">Main Lagi</a>
  </div>
</div>

<div class="confetti-land">
  <?php for($i = 0; $i <= 80; $i++) : ?>
    <div class="confetti"></div>
  <?php endfor ?>
</div>

<select id="type">
  <option value="bookmarks" selected>Bookmarks</option>
</select>

<style>
  *{ box-sizing: border-box }
  #menang{ color: darkseagreen }
  #kalah{ color: darksalmon }
  #main{ padding: 7px 50px; margin: auto; color: lightsteelblue; background: none; border: 1px solid lightsteelblue; border-radius: 0 }
  #main:hover{ color: white; background: lightslategrey; border: 1px solid lightslategrey }
  h3{ margin-top: -5px; color: white }
  body{ background: #C4E4FF; background: radial-gradient(circle, hsl(223, 20%,12%), hsl(223, 20%,22%)); background: radial-gradient(circle, hsl(223, 40%,22%), hsl(223, 40%,12%)); overflow: hidden; height: 100vh; width: 100%; user-select: none; padding: 0; margin: 0 }
  #row{ width: 100%; height: 100%; display: table }
  #col{ display: table-cell; vertical-align: middle }
  #img{ margin: auto; width: 13% }
  .confetti{ width: 1rem; height: 1rem; display: inline-block; position: absolute; top: -1rem; left: 0; z-index: 50 }
  .confetti .rotate{ animation: driftyRotate 1s infinite both ease-in-out; perspective: 1000 }
  .confetti .askew{ background: linear-gradient(var(--grad-direction, to bottom), hsl(63, 100%, 50%) 25%, hsl(23, 100%, 50%) 0% 66.667%, hsl(43, 100%, 100%) 0% 100%); transform: skewY(10deg); width: 2rem; height: 3.2rem; animation: drifty 1s infinite alternate both ease-in-out; perspective:1000; clip-path: polygon(0% 0%, 100% 0%, 50% 100%) }
  .confetti:nth-of-type(7n) .askew{ animation-delay: -.6s; animation-duration: 2.25s }
  .confetti:nth-of-type(7n + 1) .askew{ animation-delay: -.879s; animation-duration: 3.5s }
  .confetti:nth-of-type(7n + 2) .askew{ animation-delay: -.11s; animation-duration: 1.95s }
  .confetti:nth-of-type(7n + 3) .askew{ animation-delay: -.246s; animation-duration: .85s }
  .confetti:nth-of-type(7n + 4) .askew{ animation-delay: -.43s; animation-duration: 2.5s }
  .confetti:nth-of-type(7n + 5) .askew{ animation-delay: -.56s; animation-duration: 1.75s }
  .confetti:nth-of-type(7n + 6) .askew{ animation-delay: -.76s; animation-duration: 1.5s }
  .confetti:nth-of-type(9n) .rotate{ animation-duration: 2s }
  .confetti:nth-of-type(9n + 1) .rotate{ animation-duration: 2.3s }
  .confetti:nth-of-type(9n + 2) .rotate{ animation-duration: 1.1s }
  .confetti:nth-of-type(9n + 3) .rotate{ animation-duration: .75s }
  .confetti:nth-of-type(9n + 4) .rotate{ animation-duration: 4.3s }
  .confetti:nth-of-type(9n + 5) .rotate{ animation-duration: 3.05s }
  .confetti:nth-of-type(9n + 6) .rotate{ animation-duration: 2.76s }
  .confetti:nth-of-type(9n + 7) .rotate{ animation-duration: 7.6s }
  .confetti:nth-of-type(9n + 8) .rotate{ animation-duration: 1.78s }
  #type{ display: none }

  @keyframes drifty{
    0%{ transform: skewY(10deg) translate3d(-250%, 0, 0) }
    100%{ transform: skewY(-12deg) translate3d(250%, 0, 0) }
  }

  @keyframes driftyRotate{
    0%{ transform: rotateX(0) }
    100%{ transform: rotateX(359deg) }
  }

  [data-type=bookmarks] .confetti:nth-child(4n){ color: darkorange }
  [data-type=bookmarks] .confetti:nth-child(4n + 1){ color: yellow }
  [data-type=bookmarks] .confetti:nth-child(4n + 2){ color: orangered }
  [data-type=bookmarks] .confetti:nth-child(4n + 3){ color: coral }
  [data-type=bookmarks] .confetti .askew{ background: currentColor; width: 0.5rem; height: 1rem; clip-path: polygon(evenodd, 0% 0%, 100% 0%, 100% 100%, 50% 90%, 0% 100%) }

  @media only screen and (max-width: 1024px){
    #img{ width: 25% }
  }
</style>

<script>
  var confettiPlayers = [];

  function makeItConfetti(){
    var confetti = document.querySelectorAll('.confetti');

    if (!confetti[0].animate){
      return false;
    }

    for (var i = 0, len = confetti.length; i < len; ++i){
      var candycorn       = confetti[i];
      candycorn.innerHTML = '<div class="rotate"><div class="askew"></div></div>';
      var scale           = Math.random() * .7 + .3;

      var player = candycorn.animate([
        { transform: `translate3d(${(i/len*100)}vw,-5vh,0) scale(${scale}) rotate(0turn)`, opacity: scale },
        { transform: `translate3d(${(i/len*100 + 10)}vw,105vh,0) scale(${scale}) rotate(${ Math.random() > .5 ? '' : '-'}2turn)`, opacity: 1 }
      ],{
        duration: Math.random() * 3000 + 5000,
        iterations: Infinity,
        delay: -(Math.random() * 7000)
      });

      confettiPlayers.push(player);
    }
  }

  makeItConfetti();
  onChange({currentTarget:{value: 'bookmarks'}})

  document.getElementById('type').addEventListener('change', onChange)

  function onChange(e){
    document.body.setAttribute('data-type', e.currentTarget.value);
    confettiPlayers.forEach(player => player.playbackRate = e.currentTarget.value === 'bookmarks' ? 2 : 1);
  }
</script>
