const calculator = document.querySelector('.calculator');
const display = document.querySelector('.display');

let firstOperand = null;
let operator = null;
let waitingForSecondOperand = false;

calculator.addEventListener('click', function(event) {
  const { target } = event;

  if (!target.matches('button')) {
    return;
  }

  if (target.classList.contains('operator')) {
    handleOperator(target.value);
    updateDisplay();
    return;
  }

  if (target.classList.contains('clear')) {
    clear();
    updateDisplay();
    return;
  }

  if (target.classList.contains('equal')) {
    firstOperand = calculate();
    display.textContent = firstOperand;
    operator = null;
    waitingForSecondOperand = true;
    updateDisplay();
    return;
  }

  inputDigit(target.value);
  updateDisplay();
});

function inputDigit(digit) {
  if (waitingForSecondOperand === true) {
    display.textContent = digit;
    waitingForSecondOperand = false;
  } else {
    display.textContent = display.textContent === '0' ? digit : display.textContent + digit;
  }
}

function handleOperator(nextOperator) {
  const inputValue = parseFloat(display.textContent);

  if (operator && waitingForSecondOperand)  {
    operator = nextOperator;
    return;
  }

  if (firstOperand == null) {
    firstOperand = inputValue;
  } else if (operator) {
    const result = calculate();
    display.textContent = result;
    firstOperand = result;
  }

  waitingForSecondOperand = true;
  operator = nextOperator;
}

function calculate() {
  const inputValue = parseFloat(display.textContent);

  console.log(inputValue);
  console.log(firstOperand);
  console.log(operator);

  if (operator === '+') {
    return firstOperand + inputValue;
  } else if (operator === '-') {
    return firstOperand - inputValue;
  } else if (operator === '*') {
    return firstOperand * inputValue;
  } else if (operator === '/') {
    return firstOperand / inputValue;
  }

  return inputValue;
}

function clear() {
  display.textContent = '0';
  firstOperand = null;
  operator = null;
  waitingForSecondOperand = false;
}

function updateDisplay() {
  const inputValue = parseFloat(display.textContent);

  if (isNaN(inputValue)) {
    display.textContent = '';
  } else {
    display.textContent = inputValue;
  }
}