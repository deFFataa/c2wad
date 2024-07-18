function addItem() {
    let container = document.getElementById('input-container');

    let itemCount = container.children.length;

    let input1Col = document.createElement('div');
    input1Col.className = 'col-10 py-3';

    let input1 = document.createElement('input');
    input1.type = 'text';
    input1.name = 'item' + itemCount;
    input1.className = 'form-control';
    input1.placeholder = 'Add Something';
    input1.required = true;

    input1Col.appendChild(input1);

    let input2Col = document.createElement('div');
    input2Col.className = 'col-2 py-3';

    let input2 = document.createElement('input');
    input2.type = 'number';
    input2.name = 'quantity' + itemCount;
    input2.className = 'form-control';

    input2Col.appendChild(input2);

    container.appendChild(input1Col);
    container.appendChild(input2Col);
}

let currentStep = 1;
const previousBtn = document.querySelector(".modal-footer button.btn-secondary");
const nextBtn = document.querySelector(".modal-footer button.btn-primary");
const placeOrderBtn = document.querySelector(".modal-footer button.btn-place-order");

previousBtn.style.display = "none";
placeOrderBtn.style.display = "none";


const storeName = document.querySelector("#storeName")
const orderDetails = document.querySelector("#orderDetails")
const municipality = document.querySelector("#municipality")
const barangay = document.querySelector("#barangay")


function showStep(stepNumber) {
    const steps = document.getElementsByClassName("step");
    for (let i = 0; i < steps.length; i++) {
        if (i + 1 === stepNumber) {
            steps[i].style.display = "block";
        } else {
            steps[i].style.display = "none";
        }
    }

    currentStep = stepNumber;

    if (stepNumber === 1) {
        previousBtn.style.display = "none";
        placeOrderBtn.style.display = "none";
        nextBtn.style.display = "block";

    } else if (stepNumber === 2) {
        previousBtn.style.display = "block";
        nextBtn.style.display = "block";
        placeOrderBtn.style.display = "none";
    } else if (stepNumber === 3) {
        previousBtn.style.display = "block";
        nextBtn.style.display = "none";
        placeOrderBtn.style.display = "block";
    }
}

const errMessage = document.querySelector('#errMessage')
const errMessage2 = document.querySelector('#errMessage2')

function nextStep() {
    if (currentStep === 1) {
        if (storeName.value.trim() === '' || orderDetails.value.trim() === '') {
            if (storeName.value.trim() === '') {
                storeName.style.border = "1px solid red";
            }
            if (orderDetails.value.trim() === '') {
                orderDetails.style.border = "1px solid red";
            }
            errMessage.textContent = "Input Fields are Required"

            setTimeout(() => {
                errMessage.textContent = "";
            }, 3000);

            return;
        }
    } else if (currentStep === 2) {
        const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
        if (!selectedPaymentMethod) {

            errMessage2.textContent = "Select Payment Method"
            setTimeout(() => {
                errMessage2.textContent = "";
            }, 3000);

            return;
        }
    }

    if (currentStep < 3) {
        showStep(currentStep + 1);
    }
}



function previousStep() {
    if (currentStep > 1) {
        showStep(currentStep - 1);
    }
}

function placeOrder() {
    console.log("Order placed!");
}


