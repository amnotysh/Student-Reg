function clearInputField() {
  document.querySelector(".form__container").reset()
}

let reg_container = document.querySelector('.reg__container');
let regSubmitBtn = document.querySelector('.reg__submit');

regSubmitBtn.addEventListener('click', function() {
  reg_container.classList.toggle('hide');
})

function hideSection() {
  reg_container.classList.add('hide');
}

function toggleOtherHobbies(checkbox) {
  const inputField = document.getElementById('otherHobbiesInput');
  inputField.disabled = !checkbox.checked;
  if (checkbox.checked) inputField.focus(); 
}

document.addEventListener('DOMContentLoaded', function() {
  const othersCheckbox = document.querySelector('input[name="hobbies[]"][value="Others:"]');
  const otherHobbiesInput = document.getElementById('otherHobbiesInput');
  otherHobbiesInput.disabled = !othersCheckbox.checked;
});

function closeModal() {
  const modal = document.querySelector('.card__main__container');
  if (modal) {
    modal.classList.add('closeWindow'); // Hide the modal by adding a 'closeWindow' class
  }
}