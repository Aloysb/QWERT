const ajaxUpdateProfile = (inputsValue) => {
  let sex = document.querySelector('.sex').querySelector('input:checked').value;
  let data = {
    firstName: inputsValue[0],
    name: inputsValue[1],
    birth_date: inputsValue[3],
    sex: sex,
    ecn_year: inputsValue[6],
    ecn_place: inputsValue[7],
    ecn_school: inputsValue[8],
    status: inputsValue[9],
  };
  $.ajax({
    url: `updateProfile`,
    method: 'POST',
    data: data,
  }).done(function (data) {
    location.reload();
  });
};

const editProfile = () => {
  // Save profile details;

  document.getElementById('edit-profile').addEventListener('click', () => {
    let inputs = document.querySelectorAll('.titlevalue');
    let actions = document.querySelector('.profile-actions');
    inputs.forEach((el) => {
      el.disabled = false;
    });

    document.getElementById('confirm').hidden = false;

    let actionsEditProfile = `
  <div id='save-edit' class = 'btn btn-success'>Enregister</div>
  <div id='cancel-edit' class = 'btn btn-danger'>Annuler</div>
  `;

    let actionsDisplayProfile = `
  <div class='btn btn-outline-primary' id="edit-profile">Modifier</div>
  `;

    actions.innerHTML = actionsEditProfile;
    document.getElementById('confirm').addEventListener('click', () => {
      let inputsValue = [...document.querySelectorAll('.titlevalue')].map(
        (input) => input.value
      );
      console.log(inputsValue);
      ajaxUpdateProfile(inputsValue);
    });

    document.getElementById('save-edit').addEventListener('click', () => {
      let inputsValue = [...document.querySelectorAll('.titlevalue')].map(
        (input) => input.value
      );
      console.log(inputsValue);
      ajaxUpdateProfile(inputsValue);
    });

    document.getElementById('cancel-edit').addEventListener('click', () => {
      document.getElementById('confirm').hidden = true;
      actions.innerHTML = actionsDisplayProfile;
      inputs.forEach((el) => {
        el.disabled = true;
      });
      inputs[0].value = initialFirstName;
      inputs[1].value = initialName;
      inputs[2].value = initialEmail;
      inputs[3].value = initialLogin;
      inputs[4].value = birth_date;
      inputs[5].value = sex;
      inputs[6].value = ecn_year;
      inputs[7].value = ecn_place;
      inputs[8].value = ecn_school;
      inputs[9].value = status;

      editProfile();
    });
  });
};

editProfile();
