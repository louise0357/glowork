/**
 * Account Settings - Account
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const formAccSettings = document.querySelector('#formAccountSettings'),
      deactivateAcc = document.querySelector('#formAccountDeactivation'),
      deactivateButton = deactivateAcc.querySelector('.deactivate-account'),
      TagifyCountrySuggestionEl = document.querySelector('#TagifyCountrySuggestion'),
      TagifyLanguageSuggestionEl = document.querySelector('#TagifyLanguageSuggestion');

    const whitelist = [
      'Australia',
      'Bangladesh',
      'Belarus',
      'Brazil',
      'Canada',
      'China',
      'France',
      'Germany',
      'India',
      'Indonesia',
      'Israel',
      'Italy',
      'Japan',
      'Korea',
      'Mexico',
      'Philippines',
      'Russian Federation',
      'South Africa',
      'Thailand',
      'Turkey',
      'Ukraine',
      'United Arab Emirates',
      'United Kingdom',
      'United States'
    ];
    const langaugelist = ['Portuguese', 'German', 'French', 'English'];
    // List
    let TagifyCountrySuggestion = new Tagify(TagifyCountrySuggestionEl, {
      whitelist: whitelist,
      maxTags: 20,
      dropdown: {
        maxItems: 20,
        classname: '',
        enabled: 0,
        closeOnSelect: false
      }
    });
    let TagifyLanguageSuggestion = new Tagify(TagifyLanguageSuggestionEl, {
      whitelist: langaugelist,
      dropdown: {
        classname: '',
        enabled: 0,
        closeOnSelect: false
      }
    });
    // Form validation for Add new record
    if (formAccSettings) {
      const fv = FormValidation.formValidation(formAccSettings, {
        fields: {
          firstName: {
            validators: {
              notEmpty: {
                message: 'Please enter first name'
              }
            }
          },
          lastName: {
            validators: {
              notEmpty: {
                message: 'Please enter last name'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.col-md-6'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),
          // Submit the form when all fields are valid
          // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
          autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      });
    }

    // Disable Button till checkbox checked

    const accountActivation = document.querySelector('#accountActivation');

    if (deactivateAcc) {
      const fv = FormValidation.formValidation(deactivateAcc, {
        fields: {
          accountActivation: {
            validators: {
              notEmpty: {
                message: 'Please confirm you want to delete account'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: ''
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),
          fieldStatus: new FormValidation.plugins.FieldStatus({
            onStatusChanged: function (areFieldsValid) {
              if (areFieldsValid && accountActivation.checked == true) {
                // Enable the submit button if all fields are valid and checkbox is not checked
                deactivateButton.removeAttribute('disabled', 'disabled');
                deactivateButton.classList.add('btn-danger');
                deactivateButton.classList.remove('btn-secondary');
              } else {
                // Disable the submit button if any field is invalid or checkbox is checked
                deactivateButton.setAttribute('disabled', 'disabled');
              }
            }
          }),
          // Submit the form when all fields are valid
          // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
          autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      });
    }

    // Deactivate account alert

    // Alert With Functional Confirm Button
    if (deactivateButton) {
      deactivateButton.onclick = function () {
        if (accountActivation.checked == true) {
          Swal.fire({
            text: 'Are you sure you would like to deactivate your account?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            customClass: {
              confirmButton: 'btn btn-primary me-2 waves-effect waves-light',
              cancelButton: 'btn btn-outline-secondary waves-effect'
            },
            buttonsStyling: false
          }).then(function (result) {
            if (result.value) {
              Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Your file has been deleted.',
                customClass: {
                  confirmButton: 'btn btn-success waves-effect'
                }
              });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              Swal.fire({
                title: 'Cancelled',
                text: 'Deactivation Cancelled!!',
                icon: 'error',
                customClass: {
                  confirmButton: 'btn btn-success waves-effect'
                }
              });
            }
          });
        }
      };
    }

    // CleaveJS validation

    const phoneNumber = document.querySelector('#phoneNumber'),
      zipCode = document.querySelector('#zipCode');
    // Phone Mask
    if (phoneNumber) {
      new Cleave(phoneNumber, {
        phone: true,
        phoneRegionCode: 'US'
      });
    }

    // Pincode
    if (zipCode) {
      new Cleave(zipCode, {
        delimiter: '',
        numeral: true
      });
    }

    // Update/reset user image of account page
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input'),
      resetFileInput = document.querySelector('.account-image-reset');

    if (accountUserImage) {
      const resetImage = accountUserImage.src;
      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
        }
      };
      resetFileInput.onclick = () => {
        fileInput.value = '';
        accountUserImage.src = resetImage;
      };
    }
  })();
});

// Select2 (jquery)
$(function () {
  var select2 = $('.select2');
  // For all Select2
  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      select2Focus($this);
      $this.wrap('<div class="position-relative"></div>');
      $this.select2({
        dropdownParent: $this.parent()
      });
    });
  }
});
