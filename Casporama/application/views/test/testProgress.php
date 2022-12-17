<!-- test/testProgress -->

<script type="text/javascript" src="<?= base_url() ?>static/js/lib/progressBarLib.js"></script>

<style type="text/css">

#progressBar {
    margin: 20px;
  width: 400px;
  height: 8px;
  position: relative;
}

</style>

<div id="progressBar"></div>

<script type="text/javascript">

function entierAleatoire(min, max)
{
 return Math.floor(Math.random() * (max - min + 1)) + min;
}

var loadingTime = entierAleatoire(5000, 10000);

var bar = new ProgressBar.Line(progressBar, {
  strokeWidth: 4,
  easing: 'bounce',
  duration: loadingTime - 500,
  color: '#77DD77',
  trailColor: '#FDFD96',
  trailWidth: 1,
  svgStyle: {width: '100%', height: '100%'},
  text: {
    style: {
      // Text color.
      // Default: same as stroke color (options.color)
      color: '#77B5FE',
      position: 'absolute',
      right: '0',
      top: '30px',
      padding: 0,
      margin: 0,
      transform: null
    },
    autoStyleContainer: true
  },
  from: {color: '#FF857E', width: 1},
  to: {color: '#77DD77', width: 4},
  step: (state, bar) => {
    bar.path.setAttribute('stroke-width', state.width);
    bar.path.setAttribute('stroke', state.color);
    bar.setText(Math.round(bar.value() * 100) + ' %');
  }
});

bar.text.style.fontFamily = "Poppins, sans-serif";
bar.animate(1.0);  // Number from 0.0 to 1.0
</script>

<!-- test/testProgress -->
