<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Print Cost Calculator</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #eef2f7;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #FF6F00;
      display: flex;
      align-items: center;
      justify-content: flex-start;
     
    }

    .navbar img {
      max-width: 80px;
      margin-left: 120px;
    }

    .row {
    display: flex;
    gap: 35px; 
    margin-bottom: 15px;
  }

  .input-group {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  

    .main-container {
      display: flex;
      justify-content: center;
      gap: 30px;
      padding: 25px 20px;
    }

    .form-container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      width: 400px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    .result-container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      flex: 1;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
      font-size: 24px;
      font-weight: bold;
    }

    label {
      font-weight: 600;
      margin-bottom: 8px;
      display: block;
      color: #444;
    }

    select, input {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 15px;
      background: #f9f9f9;
    }

    .btn-primary {
      background-color: #FF6F00;
      border: none;
      padding: 10px 20px;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
      margin-right: 10px;
    }

    .btn-success {
      background-color: #FF6F00;
      border: none;
      padding: 10px 20px;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
      margin-right: 10px;
    }

    .btn-primary:hover {
      background-color: #e66000;
      transform: scale(1.05);
    }

    .btn-secondary {
      background-color: #6c757d;
      border: none;
      padding: 10px 20px;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
      background-color: #5a6268;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
      font-size: 15px;
    }

    th {
      background: #f1f1f1;
      font-weight: 700;
    }

    .paperWrapper {
      margin-top: 30px;
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      border: 2px dashed #bbb;
      padding: 20px;
      justify-content: center;
      background: #fafafa;
      border-radius: 10px;
    }

    .copy {
      background: #dfe9f3;
      border: 1px solid #a0b3c5;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      font-weight: 600;
      color: #333;
      padding: 5px;
    }
  </style>
</head>
<body>

<div class="navbar">
  <img src="{{ asset('images/logo.png') }}" alt="Logo">
</div>

    <div class="main-container">
  <div class="form-container">
  <form id="printForm" method="POST" action="{{ route('save.print') }}">
    @csrf
      <label for="paperSize">Product Name:</label>
      <select id="paperSize">
        <option value="">Select</option>
        <option value="Sun Pack">Sun Pack</option>
        <option value="custom">Custom</option>
      </select>

      <div class="row">
        <div class="input-group">
          <label for="customPaperWidth">Paper Width (inch):</label>
          <input type="number" id="customPaperWidth" name="paper_width" step="0.01">
        </div>

        <div class="input-group">
          <label for="customPaperHeight">Paper Height (inch):</label>
          <input type="number" id="customPaperHeight" name="paper_height" step="0.01">
        </div>
      </div>

      <label for="orientation">Orientation:</label>
      <select id="orientation" name="orientation">
        <option value="portrait">Portrait</option>
        <option value="landscape">Landscape</option>
      </select>

      <div class="row">
        <div class="input-group">
          <label for="customWidth">Custom Print Width (inch):</label>
          <input type="number" id="customWidth" name="custom_width" step="0.01">
        </div>

        <div class="input-group">
          <label for="customHeight">Custom Print Height (inch):</label>
          <input type="number" id="customHeight" name="custom_height" step="0.01">
        </div>
      </div>
      <label for="totalCopies">Total Copies:</label>
      <input type="number" id="totalCopies" name="total_copies">
      <button type="button" onclick="calculateResult()" class="btn-primary">Calculate</button>
      <button type="submit" class="btn-success">Save</button>
      <button type="button" onclick="resetForm()" class="btn-secondary">Reset</button>
    </form>
  </div>

  <div class="result-container">
    <div class="resultDtls"></div>
  </div>
</div>

<script>
  function resetForm() {
    document.getElementById("printForm").reset();
    document.querySelector('.resultDtls').innerHTML = '';
  }

  function calculateResult() {
    const orientation = document.getElementById('orientation').value;
    let paperWidth = parseFloat(document.getElementById('customPaperWidth').value);
    let paperHeight = parseFloat(document.getElementById('customPaperHeight').value);
    const customWidth = parseFloat(document.getElementById('customWidth').value);
    const customHeight = parseFloat(document.getElementById('customHeight').value);
    const totalCopies = parseInt(document.getElementById('totalCopies').value);

    if ([paperWidth, paperHeight, customWidth, customHeight, totalCopies].some(isNaN)) {
      alert('Please enter all valid numbers!');
      return;
    }

    if (orientation === 'landscape') {
      [paperWidth, paperHeight] = [paperHeight, paperWidth];
    }

    const fitW = Math.floor(paperWidth / customWidth);
    const fitH = Math.floor(paperHeight / customHeight);
    const perSheet = fitW * fitH;

    if (perSheet <= 0) {
      alert("Print size too big for selected paper");
      return;
    }

    const totalSheets = Math.ceil(totalCopies / perSheet);
    const totalSqFt = (customWidth * customHeight * totalCopies) / 144;
    const baseCost = totalSqFt * 17.70;

    let extraCharge = 0;
    if (totalSqFt < 49) {
      extraCharge = 600;
    } else if (totalSqFt >= 50 && totalSqFt <= 99) {
      extraCharge = 500;
    } else if (totalSqFt >= 100 && totalSqFt <= 499) {
      extraCharge = 300;
    }

    const totalCost = baseCost + extraCharge;

    const result = document.querySelector('.resultDtls');
    result.innerHTML = `
      <h2>Custom Paper Size = 48 X 72 Inch</h2>
      <div class="paperWrapper">
        ${Array.from({length: perSheet}).map(() => `
          <div class="copy" style="width:${customWidth * 3}px; height:${customHeight * 3}px;">
            Print
          </div>`).join('')}
      </div>

      <table>
        <tr><th>Number of copies in 1 sheet</th><td>${perSheet}</td></tr>
        <tr><th>Total Papers Required</th><td>${totalSheets}</td></tr>
        <tr><th>Total Copy of Print</th><td>${perSheet * totalSheets}</td></tr>
        <tr><th>Total Sqft</th><td>${totalSqFt.toFixed(2)}</td></tr>
        <tr><th>Base Cost</th><td>₹${baseCost.toFixed(2)}</td></tr>
        <tr><th>Extra Charge</th><td>₹${extraCharge}</td></tr>
        <tr><th><b>Total Printing Cost</b></th><td><b>₹${totalCost.toFixed(2)}</b></td></tr>
      </table>
    `;
  }

  document.getElementById('paperSize').addEventListener('change', function() {
    if (this.value === 'Sun Pack') {
        document.getElementById('customPaperWidth').value = 72;
        document.getElementById('customPaperHeight').value = 42;
    } else {
        document.getElementById('customPaperWidth').value = '';
        document.getElementById('customPaperHeight').value = '';
    }
});
</script>

</body>
</html>
