<!-- butang-saiz.php -->
<div class="button-group">
  | Change Font Size |
  <input name="rb" type="button" value="Reset" onclick="ubahsaiz(0)" />
  <input name="r" type="button" value=" + " onclick="ubahsaiz(1)" />
  <input name="rk" type="button" value=" - " onclick="ubahsaiz(-1)" />
  |
  <button onclick="window.print()">Print</button>
</div>

<style>
  .button-group {
    margin: 10px 0;
    text-align: right;
  }

  .button-group input[type='button'],
  .button-group button {
    background-color: #D69ADE;
    border: none;
    padding: 8px 14px;
    margin: 2px;
    border-radius: 6px;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s ease;
    font-size: 0.95em;
  }

  .button-group input[type='button']:hover,
  .button-group button:hover {
    background-color: #AA60C8;
  }
</style>

<script>
  // Track the current font size state
  let fontSizeMultiplier = 1;

  function ubahsaiz(change) {
    const target = document.getElementById("saiz");

    if (change === 0) {
      fontSizeMultiplier = 1;
    } else {
      fontSizeMultiplier += change * 0.1;
      fontSizeMultiplier = Math.max(0.5, Math.min(fontSizeMultiplier, 2)); // Limit size between 0.5x and 2x
    }

    target.style.fontSize = fontSizeMultiplier + "em";
  }
</script>




