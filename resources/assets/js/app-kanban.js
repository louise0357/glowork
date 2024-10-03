/**
 * App Kanban
 */
import { all } from 'axios';
import toastr from 'toastr/toastr';
import SwalPlugin from 'sweetalert2/dist/sweetalert2';
const Swal = SwalPlugin.mixin({
  buttonsStyling: false,
  customClass: {
    confirmButton: 'btn btn-primary',
    cancelButton: 'btn btn-outline-danger',
    denyButton: 'btn btn-outline-secondary'
  }
});

try {
  window.Swal = Swal;
} catch (e) {}

export { Swal };


'use strict';

let boards = null;

(async function () {
  const kanbanSidebar = document.querySelector('.kanban-update-item-sidebar'),
    kanbanWrapper = document.querySelector('.kanban-wrapper'),
    commentEditor = document.querySelector('.comment-editor'),
    kanbanAddNewBoard = document.querySelector('.kanban-add-new-board'),
    kanbanAddNewInput = [].slice.call(document.querySelectorAll('.kanban-add-board-input')),
    kanbanAddBoardBtn = document.querySelector('.kanban-add-board-btn'),
    datePicker = document.querySelector('#due-date'),
    confirmText = document.querySelector('#confirm-text'),

    select2 = $('.select2'), // ! Using jquery vars due to select2 jQuery dependency
    assetsPath = document.querySelector('html').getAttribute('data-assets-path');

  // Init kanban Offcanvas
  const kanbanOffcanvas = new bootstrap.Offcanvas(kanbanSidebar);
  if (confirmText) {
    confirmText.onclick = function () {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
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
        }
      });
    };
  }
  // Get kanban data
  const path = window.location.pathname; // url al
  const idMatch = path.match(/\/boards\/(\d+)/); // id cekme

  if (idMatch && idMatch[1]) {
    const boardId = parseInt(idMatch[1], 10);
    if (!isNaN(boardId) && boardId > 0) {
      try {
          const response = await fetch(`/kanban/board/${boardId}`);
    if (response.ok) {

          boards = await response.json();
boards.sort((a, b) => a.order - b.order);

initKanban(boards);
} else {
  toastr.error("Böyle bir kanban yok!", "Hata!")
}
      } catch (error) {
          console.error('Error fetching Kanban board data:', error);
      }
    }
  } else {
      console.error('No board ID found in URL.');
  }

if (datePicker) {
  datePicker.flatpickr({
    enableTime: true,
    time_24hr: true,
    altInput: true,
    altFormat: 'j F, Y H:i',
    dateFormat: 'Y-m-d H:i:S',
    defaultHour: 12,
    defaultMinute: 0, 
    secondIncrement: 1
  });
}

  //! TODO: Update Event label and guest code to JS once select removes jQuery dependency
  // select2
  if (select2.length) {
    function renderLabels(option) {
      if (!option.id) {
        return option.text;
      }
      var $badge = "<div class='badge " + $(option.element).data('color') + " rounded-pill'> " + option.text + '</div>';
      //var $badge = "<div class='badge rounded-pill bg-label-info rounded-pill'> " + option.text + '</div>';

      return $badge;
    }

    select2.each(function () {
      var $this = $(this);
      select2Focus($this);
      $this.wrap("<div class='position-relative'></div>").select2({
        placeholder: 'Select Label',
        dropdownParent: $this.parent(),
        templateResult: renderLabels,
        templateSelection: renderLabels,
        escapeMarkup: function (es) {
          return es;
        }
      });
    });
  }

  // Comment editor
  if (commentEditor) {
    new Quill(commentEditor, {
      modules: {
        toolbar: '.comment-toolbar'
      },
      placeholder: 'Write a Comment... ',
      theme: 'snow'
    });
  }

  // Render board dropdown
  function renderBoardDropdown() {
    return (
      "<div class='dropdown'>" +
      "<i class='dropdown-toggle ri-more-2-line ri-20px cursor-pointer' id='board-dropdown' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'></i>" +
      "<div class='dropdown-menu dropdown-menu-end' aria-labelledby='board-dropdown'>" +
      "<a class='dropdown-item delete-board' href='javascript:void(0)'> <i class='ri-delete-bin-7-line'></i> <span class='align-middle'>Delete</span></a>" +
      "<a class='dropdown-item' href='javascript:void(0)'><i class='ri-edit-2-line'></i> <span class='align-middle'>Rename</span></a>" +
      "<a class='dropdown-item' href='javascript:void(0)'><i class='ri-archive-line'></i> <span class='align-middle'>Archive</span></a>" +
      '</div>' +
      '</div>'
    );
  }
  // Render item dropdown
  function renderDropdown() {
    return (
      "<div class='dropdown kanban-tasks-item-dropdown'>" +
      "<i class='dropdown-toggle ri-more-2-line ri-20px text-muted' id='kanban-tasks-item-dropdown' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'></i>" +
      "<div class='dropdown-menu dropdown-menu-end' aria-labelledby='kanban-tasks-item-dropdown'>" +
      "<a class='dropdown-item' href='javascript:void(0)'>Copy task link</a>" +
      "<a class='dropdown-item' href='javascript:void(0)'>Duplicate task</a>" +
      "<a class='dropdown-item delete-task' href='javascript:void(0)'>Delete</a>" +
      '</div>' +
      '</div>'
    );
  }
  // Render header
  function renderHeader(color, text) {
    return (
      "<div class='d-flex justify-content-between flex-wrap align-items-center mb-2'>" +
      "<div class='item-badges d-flex' style='color: #800d22 !important'> " +
      "<div class='badge rounded-pill bg-label-info'> " +
      text +
      '</div>' +
      '</div>' +
      renderDropdown() +
      '</div>'
    );
  }

  // Render avatar
  function renderAvatar(images, pullUp, size, margin, members) {
    var $transition = pullUp ? ' pull-up' : '',
      $size = size ? 'avatar-' + size + '' : '',
      member = members == undefined ? ' ' : members.split(',');

    return images == undefined
      ? ' '
      : images
          .split(',')
          .map(function (img, index, arr) {
            var $margin = margin && index !== arr.length - 1 ? ' me-' + margin + '' : '';
if (member[index]) {
            return (
              "<div class='avatar " +
              $size +
              $margin +
              "'" +
              "data-bs-toggle='tooltip' data-bs-placement='top'" +
              "title='" +
              member[index] +
              "'" +
              '>' +
              "<img src='" +
              img +
              "' alt='Avatar' class='rounded-circle " +
              $transition +
              "'>" +
              '</div>'
            );
          }
          })
          .join(' ');
  }

  // Render footer
  function renderFooter(type, due_date, comments, assigned, members) {
    const currentDate = new Date();
    const dueDate = new Date(due_date);
  
    const timeDifference = dueDate - currentDate;
  
    const daysDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
  
    let dueDateColor = '';
    if (daysDifference > 0 && daysDifference <= 1) {
      dueDateColor = 'color: #c90202;';
    } else if (daysDifference > 0 && daysDifference <= 3) {
      dueDateColor = 'color: #c27304;';
    }
    return (
      "<div class='d-flex justify-content-between align-items-center flex-wrap mt-2'>" +
      "<div> <span class='align-middle me-4'><i class='ri-calendar-todo-line'></i>" +
      "<span class='due-date' style='font-size: 80% !important; " + dueDateColor + "'>&nbsp" +
      due_date +
      '</span>' +
      "</span>" + '</div>' +
      "<div class='avatar-group d-flex align-items-center assigned-avatar'>" +
      renderAvatar(assigned, true, 'xs', null, members) +
      '</div>' +
      '</div>'
    );

  }
  





// KRAL BURASI KANBAN INIT START 

  function initKanban(boards) {
    // Init kanban
    const kanban = new jKanban({
      element: '.kanban-wrapper',
      gutter: '12px',
      widthBoard: '250px',
      dragItems: true,
      boards: boards,
      dragBoards: true,
      addItemButton: true,
      buttonContent: '+ Add Item',
      dragendEl: function(el, source) {

  
        var taskId = el.dataset.eid; // Task ID'si
        var newBoardId = el.parentElement.parentElement.dataset.id; // Yeni board ID'si
  
        updateTaskBoard(taskId, newBoardId);
    },
    dropEl: function(el, target, source, sibling) {
      var sourceId = $(source).closest("div.kanban-board").attr("data-id"),
          targetId = $(target).closest("div.kanban-board").attr("data-id");
      
      if(source === target) {
      } else {
      }
  },
    dragendBoard: function (el) {
      const boardElements = document.querySelectorAll('.kanban-board');
      const boardOrder = Array.from(boardElements).map((board, index) => {
        return {
          id: extractTaskId(board.dataset.id),
          order: index + 1 
        };
      });
      const idd = path.match(/\/boards\/(\d+)/); // ID'yi yakalar
      const id = idd[1];
    
      updateListOrder(id, boardOrder);
    },
      itemAddOptions: {
        enabled: true, // add a button to board for easy item creation
        content: '+ Add New Item', // text or html content of the board button
        class: 'kanban-title-button btn btn-default text-heading fw-normal shadow-none text-capitalize', // default class of the button
        footer: false // position the button on footer
      },
      click: function (el) {
        let element = el;


      if (element.getAttribute('data-type') === 'sendedfromtable') {
        if (!document.querySelector('.task-edit-modal .fetchDetailsBtn')) {
          let otherDetailsButton = document.createElement('a');
          otherDetailsButton.textContent = 'Other Details';
          otherDetailsButton.classList.add('fetchDetailsBtn', 'me-4', 'btn', 'btn-outline-primary', 'waves-effect');
          otherDetailsButton.setAttribute('data-bs-toggle', 'modal');
          otherDetailsButton.setAttribute('data-bs-target', '#detailsModal');
          otherDetailsButton.setAttribute('href', 'javascript:0;');

          let updateTaskBtn = document.getElementById('updateTaskBtn');
          if (updateTaskBtn) {
            updateTaskBtn.parentNode.insertBefore(otherDetailsButton, updateTaskBtn.nextSibling);
          } else {
            document.querySelector('.task-edit-modal').appendChild(otherDetailsButton);
          }

          otherDetailsButton.addEventListener('click', function() {
            const taskId = el.getAttribute('data-eid');
            openDetailsModal(taskId);
          });
        }
      } else {
        let existingButton = document.querySelector('.task-edit-modal .fetchDetailsBtn');
        if (existingButton) {
          existingButton.remove();
        }
      }



        
        let title = element.getAttribute('data-eid')
            ? element.querySelector('.kanban-text').textContent
            : element.textContent,
          date = element.getAttribute('data-due-date'),
          
          dateObj = new Date(),
          year = dateObj.getFullYear(),
          dateToUse = date
            ? date + ', ' + year
            : dateObj.getDate() + ' ' + dateObj.toLocaleString('en', { month: 'long' }) + ', ' + year,
          label = element.getAttribute('data-badge-text'),
          description = element.getAttribute('data-description'),
          avatars = element.getAttribute('data-assigned');
  
        kanbanOffcanvas.show();
        

        kanbanSidebar.querySelector('#title').value = title;
        kanbanSidebar.querySelector('#description').value = description;
        kanbanSidebar.querySelector('#due-date').nextSibling.value = dateToUse;
        

        // ! Using jQuery method to get sidebar due to select2 dependency
        $('.kanban-update-item-sidebar').find(select2).val(label).trigger('change');
  
        // Remove & Update assigned
        kanbanSidebar.querySelector('.assigned').innerHTML = '';
        kanbanSidebar
          .querySelector('.assigned')
          .insertAdjacentHTML(
            'afterbegin',
            renderAvatar(avatars, false, 'sm', '2', el.getAttribute('data-members')) +
              "<div class='avatar avatar-sm ms-2' data-bs-target='#AddUserAsign' data-bs-toggle='modal'>" +
              "<span class='avatar-initial rounded-circle bg-label-secondary'><i class='ri-pencil-line'></i></span>" +
              '</div>'
          );
      },
  
      buttonClick: function (el, boardId) {
        const addNew = document.createElement('form');
        addNew.setAttribute('class', 'new-item-form');
        addNew.innerHTML =
          '<div class="mb-4">' +
          '<textarea class="form-control add-new-item" rows="2" placeholder="Add Content" autofocus required></textarea>' +
          '</div>' +
          '<div class="mb-4">' +
          '<button type="submit" class="btn btn-primary btn-sm me-4">Add</button>' +
          '<button type="button" class="btn btn-outline-secondary btn-sm cancel-add-item">Cancel</button>' +
          '</div>';
        kanban.addForm(boardId, addNew);
      
        addNew.addEventListener('submit', function (e) {
          e.preventDefault();
          const taskContent = e.target[0].value;
          const currentBoard = [].slice.call(
            document.querySelectorAll('.kanban-board[data-id=' + boardId + '] .kanban-item')
          );
      
          fetch('/kanban/addtask', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
              board_id: extractTaskId(boardId),
              content: taskContent
            })
          })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                kanban.addElement(boardId, {
                  title: "<span class='kanban-text'>" + taskContent + '</span>',
                  id: taskId
                });
      
                const kanbanText = [].slice.call(
                  document.querySelectorAll('.kanban-board[data-id=' + boardId + '] .kanban-text')
                );
                kanbanText.forEach(function (e) {
                  e.insertAdjacentHTML('beforebegin', renderDropdown());
                });
      
                const newTaskDropdown = [].slice.call(document.querySelectorAll('.kanban-item .kanban-tasks-item-dropdown'));
                if (newTaskDropdown) {
                  newTaskDropdown.forEach(function (e) {
                    e.addEventListener('click', function (el) {
                      el.stopPropagation();
                    });
                  });
                }
      
                const deleteTask = [].slice.call(
                  document.querySelectorAll('.kanban-board[data-id=' + boardId + '] .delete-task')
                );
                deleteTask.forEach(function (e) {
                  e.addEventListener('click', function () {
                    const id = this.closest('.kanban-item').getAttribute('data-eid');
                    kanban.removeElement(id);
                  });
                });
              } else {
                alert('Error: ' + data.message);
              }
            })
            .catch(error => console.error('Error:', error));
      
          addNew.remove();
        });
      
        addNew.querySelector('.cancel-add-item').addEventListener('click', function (e) {
          addNew.remove();
        });
      }
      
    });
    }

// BURASIDA KANBAN INITIN BITISI KRAL.D








  function updateListOrder(boardId, lists) {
    $.ajax({
        url: '/kanban/update-order',
        method: 'POST',
        data: {
            board_id: boardId,
            lists: lists,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('Order updated successfully.');
        },
        error: function(xhr) {
            console.error('Error updating order:', xhr.responseText);
        }
    });
}

  function updateTaskBoard(taskId, newBoardId) {
    fetch('/kanban/update-task-board', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            task_id: taskId,
            new_board_id: newBoardId
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            console.log('Task successfully moved to the new board!');
        } else {
            console.error('Error moving task:', data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

document.querySelectorAll('.kanban-item').forEach(function(task) {
  task.addEventListener('click', function() {
    const taskId = this.getAttribute('data-eid'); 
    document.getElementById('taskId').value = taskId;
    document.getElementById('taskIdAsign').value = extractTaskId(taskId);

  });
});



document.getElementById('updateTaskBtn').addEventListener('click', function(event) {
  event.preventDefault(); 

  const taskId = document.getElementById('taskId').value;
  const title = document.getElementById('title').value;
  const dueDate = document.getElementById('due-date').value;
  const label = document.getElementById('label').value;
  const description = document.getElementById('description').value;

  //const attachments = document.getElementById('attachments').files[0];

  let formData = new FormData();
  formData.append('task_id', taskId);
  formData.append('title', title);
  formData.append('due_date', dueDate);
  formData.append('label', label);
  formData.append('description', description);

 /* if (attachments) {
    formData.append('attachments', attachments);
  }
*/
  fetch('/update-task-url', {
      method: 'POST',
      headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: formData
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          toastr.success('Task başarıyla güncellendi!');
          location.reload();
      } else {
          toastr.error('Task güncellenemedi, lütfen admin ile iletişime geçin!');
      }
  })
  .catch(error => {
      console.error('Hata:', error);
  });
});

/*
function refreshKanban() {
  fetch('/kanban/board/1') 
    .then(response => response.json())
    .then(boards => {
      kanban.updateTaskBoard(boards);
    })
    .catch(error => console.error('Error:', error));
}
*/




function extractTaskId(taskIdWithPrefix) {
  return taskIdWithPrefix.split('-')[1]; // "task-1" → "1"
}


  // Kanban Wrapper scrollbar
  if (kanbanWrapper) {
    new PerfectScrollbar(kanbanWrapper);
  }

  const kanbanContainer = document.querySelector('.kanban-container'),
    kanbanTitleBoard = [].slice.call(document.querySelectorAll('.kanban-title-board')),
    kanbanItem = [].slice.call(document.querySelectorAll('.kanban-item'));

  // Render custom items
  if (kanbanItem) {
    kanbanItem.forEach(function (el) {
      const element = "<span class='kanban-text'>" + el.textContent + '</span>';
      let img = '';
      if (el.getAttribute('data-image') !== null) {
        img =
          "<img class='img-fluid mb-2 rounded-3' src='" +
          assetsPath +
          'img/elements/' +
          el.getAttribute('data-image') +
          "'>";
      }
      
      if (el.getAttribute('data-type') === "sendedfromtable") {}
      el.textContent = '';
      if (el.getAttribute('data-badge') !== undefined && el.getAttribute('data-badge-text') !== undefined) {
        el.insertAdjacentHTML(
          'afterbegin',
          renderHeader(el.getAttribute('data-badge'), el.getAttribute('data-badge-text')) + img + element
        );
      }
      if (
        el.getAttribute('data-comments') !== undefined ||
        el.getAttribute('data-due-date') !== undefined ||
        el.getAttribute('data-assigned') !== undefined
      ) {
        el.insertAdjacentHTML(
          'beforeend',
          renderFooter(
            el.getAttribute('data-type'),
            el.getAttribute('data-due-date'),
            el.getAttribute('data-comments'),
            el.getAttribute('data-assigned'),
            el.getAttribute('data-members')
          )
        );
      }
    });
  }

  // To initialize tooltips for rendered items
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // prevent sidebar to open  onclick dropdown buttons of tasks
  const tasksItemDropdown = [].slice.call(document.querySelectorAll('.kanban-tasks-item-dropdown'));
  if (tasksItemDropdown) {
    tasksItemDropdown.forEach(function (e) {
      e.addEventListener('click', function (el) {
        el.stopPropagation();
      });
    });
  }

  // Toggle add new input and actions add-new-btn
  if (kanbanAddBoardBtn) {
    kanbanAddBoardBtn.addEventListener('click', () => {
      kanbanAddNewInput.forEach(el => {
        el.value = '';
        el.classList.toggle('d-none');
      });
    });
  }

  // Render add new inline with boards
  if (kanbanContainer) {
    kanbanContainer.appendChild(kanbanAddNewBoard);
  }

  // Makes kanban title editable for rendered boards
  if (kanbanTitleBoard) {
    kanbanTitleBoard.forEach(function (elem) {
      elem.addEventListener('mouseenter', function () {
        this.contentEditable = 'true';
      });

      // Appends delete icon with title
      elem.insertAdjacentHTML('afterend', renderBoardDropdown());
    });
  }

  const deleteBoards = [].slice.call(document.querySelectorAll('.delete-board'));
  if (deleteBoards) {
      deleteBoards.forEach(function (elem) {
          elem.addEventListener('click', function () {
              const id = this.closest('.kanban-board').getAttribute('data-id');
              
              fetch(`/kanban/deleteboard/${extractTaskId(id)}`, {
                  method: 'DELETE',
                  headers: {
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                  }
              })
              .then(response => response.json())
              .then(data => {
                  if (data.success) {
                      toastr.success('Board successfully deleted!');
                      setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                  } else {
                      toastr.error('Board silinirken bir hata oluştu!');
                  }
              })
              .catch(error => {
                  toastr.error('Error deleting board');
              });
          });
      });
  }
  

  const deleteTask = [].slice.call(document.querySelectorAll('.delete-task'));

deleteTask.forEach(function (e) {
    e.addEventListener('click', function () {
        const id = this.closest('.kanban-item').getAttribute('data-eid');
        //kanban.removeElement(id);

        fetch(`/kanban/deletetask/${extractTaskId(id)}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => response.json())
          .then(data => {
              if (!data.success) {
                  toastr.error('Error deleting task');
              } else if (data.success) {
                toastr.success("Task başarıyla silindi!");
                setTimeout(() => {
                  window.location.reload();
              }, 1000);
              }
          });
    });
});


  // Cancel btn add new input
  const cancelAddNew = document.querySelector('.kanban-add-board-cancel-btn');
  if (cancelAddNew) {
    cancelAddNew.addEventListener('click', function () {
      kanbanAddNewInput.forEach(el => {
        el.classList.toggle('d-none');
      });
    });
  }

  // Add new board
if (kanbanAddNewBoard) {
    kanbanAddNewBoard.addEventListener('submit', function (e) {
        e.preventDefault();

        const thisEle = this;
        const value = thisEle.querySelector('.form-control').value;
        const idd = path.match(/\/boards\/(\d+)/);
        const id = idd[1];


        fetch('/kanban/addboard', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ board_id:id, title: value })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
                toastr.success('Board başarıyla eklendi!');
            } else {
                toastr.error('Board eklenirken bir hata oluştu.');
            }
        })
        .catch(error => {
            // Hata oluşursa mesaj göster
            toastr.error('Bir hata meydana geldi.');
            console.error('Error:', error);
        });
  



      // Adds delete board option to new board, delete new boards & updates data-order
      const kanbanBoardLastChild = document.querySelectorAll('.kanban-board:last-child')[0];
      if (kanbanBoardLastChild) {
        const header = kanbanBoardLastChild.querySelector('.kanban-title-board');
        header.insertAdjacentHTML('afterend', renderBoardDropdown());

        // To make newly added boards title editable
        kanbanBoardLastChild.querySelector('.kanban-title-board').addEventListener('mouseenter', function () {
          this.contentEditable = 'true';
        });
      }

      // Add delete event to delete newly added boards
      const deleteNewBoards = kanbanBoardLastChild.querySelector('.delete-board');
      if (deleteNewBoards) {
        deleteNewBoards.addEventListener('click', function () {
          const id = this.closest('.kanban-board').getAttribute('data-id');
          kanban.removeBoard(id);
        });
      }

      // Remove current append new add new form
      if (kanbanAddNewInput) {
        kanbanAddNewInput.forEach(el => {
          el.classList.add('d-none');
        });
      }

      // To place inline add new btn after clicking add btn
      if (kanbanContainer) {
        kanbanContainer.appendChild(kanbanAddNewBoard);
      }
    });
  }

  // Clear comment editor on close
  kanbanSidebar.addEventListener('hidden.bs.offcanvas', function () {
    kanbanSidebar.querySelector('.ql-editor').firstElementChild.innerHTML = '';
  });

  // Re-init tooltip when offcanvas opens(Bootstrap bug)
  if (kanbanSidebar) {
    kanbanSidebar.addEventListener('shown.bs.offcanvas', function () {
      const tooltipTriggerList = [].slice.call(kanbanSidebar.querySelectorAll('[data-bs-toggle="tooltip"]'));
      tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });
  }


  /*

  COMMENTTT BASLİYORRR YAVRUMMM

  */

    // Yorumları çekmek için bir fonksiyon oluştur
    const userDataElement = document.getElementById('user-data');
    const userId = userDataElement ? parseInt(userDataElement.getAttribute('data-user-id')) : null;
        
      // Example function to fetch comments for a specific task
      function fetchComments(taskId) {
          fetch(`/kanban/task/${taskId}/comments`)
              .then(response => response.json())
              .then(data => {
                  // Assuming 'data' is an array of comments
                  displayComments(data);
              })
              .catch(error => console.error('Error fetching comments:', error));
      }
  
      function displayComments(comments) {
        const commentsContainer = document.getElementById('chat-history');
        commentsContainer.innerHTML = '';
    
        comments.forEach(comment => {
            const commentElement = document.createElement('li');
            commentElement.classList.add('chat-message');
            if (comment.user_id === userId) {
                commentElement.innerHTML = `
                <div class="d-flex overflow-hidden">
                    <div class="user-avatar flex-shrink-0 me-4">
                        <div class="avatar avatar-sm">
                            <img src="${comment.user.profile_photo_url}" alt="Avatar" class="rounded-circle">
                        </div>
                        <div class="username" style="font-size: 60%; text-decoration:underline;"><strong>${comment.user.username}</strong></div>
                    </div>
                    <div class="chat-message-wrapper flex-grow-1">
                        <div class="chat-message-text">
                            <p class="mb-0">${comment.comment}</p>
                        </div>
                        <!--
                        <i class="ri-edit-line" style="font-size: 100%"></i>
                        &nbsp-->
                        <i class="ri-delete-bin-7-line" id="confirm-text" style="font-size: 100%"></i>
                        
                        &nbsp
                        <div class="text-muted mt-1">
                            <small>${new Date(comment.created_at).toLocaleTimeString()}</small>
                        </div>
                    </div>
                </div>
                <br>
                `;
            } else {
                commentElement.classList.remove('chat-message-right');
                commentElement.innerHTML = `
                <div class="d-flex overflow-hidden">
                    <div class="user-avatar flex-shrink-0 me-4">
                        <div class="avatar avatar-sm">
                            <img src="${comment.user.profile_photo_url}" alt="Avatar" class="rounded-circle" style="opacity: 70% !important">
                        </div>
                        <div class="username" style="font-size: 60%; text-decoration:underline; "><strong>${comment.user.username}</strong></div>
                    </div>
                    <div class="chat-message-wrapper flex-grow-1">
                        <div class="chat-message-text">
                            <p class="mb-0" style="color: #d5d1ea !important; opacity: 70% !important;">${comment.comment}</p>
                        </div>
                        <div class="text-muted mt-1">
                            <small>${new Date(comment.created_at).toLocaleTimeString()}</small>
                        </div>
                    </div>
                </div>
                <br>
                `;
            }
    
            commentsContainer.appendChild(commentElement);
    
            const deleteIcons = document.querySelectorAll('#confirm-text');
            deleteIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        customClass: {
                            confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                            cancelButton: 'btn btn-outline-secondary waves-effect'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/kanban/comment/delete/${comment.id}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: 'The comment has been deleted.',
                                        customClass: {
                                            confirmButton: 'btn btn-success waves-effect'
                                        }
                                    });
                                    this.closest('li').remove();
        
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'Failed to delete the comment.',
                                    });
                                }
                            });
                        }
                    });
                });
            });
        });
    }
    
    
    
    
  
      const taskElement = document.querySelector('.kanban-item'); // Örneğin, bir görev seçildiğinde
      taskElement.addEventListener('click', function () {
          const taskId = this.getAttribute('data-eid');
          fetchComments(extractTaskId(taskId));
        });




        /* 
        Add Comment Formu için task id atama 
        */
        document.querySelectorAll('.kanban-item').forEach(function(task) {
          task.addEventListener('click', function() {
            const taskId = this.getAttribute('data-eid'); 
            document.getElementById('task_id_comment_add').value = extractTaskId(taskId);
        
          });
        });


        document.getElementById('sendCommentBtn').addEventListener('click', function() {
          const taskId = document.getElementById('task_id_comment_add').value;
          const comment = document.getElementById('commentInput').value;
          const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          if (!comment) {
              Swal.fire({
                  icon: 'error',
                  title: 'Hata!',
                  text: 'Yorum boş olamaz.',
                  customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                  },
                  buttonsStyling: false
              });
              return;
          }
      
          fetch('/kanban/addcomment', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              },
              body: JSON.stringify({
                  task_id: taskId,
                  comment: comment,
              })
          })
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  Swal.fire({
                      icon: 'success',
                      title: 'Başarılı!',
                      text: 'Yorum başarıyla eklendi.',
                      customClass: {
                        confirmButton: 'btn btn-primary waves-effect waves-light',
                      },
                      buttonsStyling: false
                  });
      
                  const commentsContainer = document.getElementById('chat-history');
                  const newCommentElement = document.createElement('li');
                  //newCommentElement.classList.add('chat-message', 'chat-message-right');
                  //newCommentElement.style.float = "right"; 

                  newCommentElement.innerHTML = `
                  <div class="d-flex overflow-hidden">
                  <div class="user-avatar flex-shrink-0 me-4">
                      <div class="avatar avatar-sm">
                          <img src="${data.user.profile_photo_url}" alt="Avatar" class="rounded-circle">
                      </div>
                      <div class="username" style="font-size: 60%; text-decoration:underline;"><strong>${data.user.username}</strong></div>
                  </div>
                  <div class="chat-message-wrapper flex-grow-1">
                      <div class="chat-message-text">
                          <p class="mb-0">${data.comment.comment}</p>
                      </div>
                      <!--<i class="ri-edit-line" style="font-size: 100%"></i>
                      &nbsp-->
                      <i class="ri-delete-bin-7-line" id="confirm-text" style="font-size: 100%"></i>
                      
                      &nbsp
                      <div class="text-muted mt-1">
                          <small>${new Date(data.comment.created_at).toLocaleTimeString()}</small>
                      </div>
                  </div>
              </div>
              <br>
                  `;
      
                  commentsContainer.appendChild(newCommentElement);

                  const deleteIcons = document.querySelectorAll('#confirm-text');
                  deleteIcons.forEach(icon => {
                      icon.addEventListener('click', function() {
                          Swal.fire({
                              title: 'Are you sure?',
                              text: "You won't be able to revert this!",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonText: 'Yes, delete it!',
                              customClass: {
                                  confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                                  cancelButton: 'btn btn-outline-secondary waves-effect'
                              },
                              buttonsStyling: false
                          }).then((result) => {
                              if (result.isConfirmed) {
                                  fetch(`/kanban/comment/delete/${data.comment.id}`, {
                                      method: 'POST',
                                      headers: {
                                          'Content-Type': 'application/json',
                                          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                      }
                                  })
                                  .then(response => response.json())
                                  .then(data => {
                                      if (data.success) {
                                          Swal.fire({
                                              icon: 'success',
                                              title: 'Başarılı!',
                                              text: 'Yorum başarıyla silindi!',
                                              customClass: {
                                                  confirmButton: 'btn btn-success waves-effect'
                                              },
                                              buttonsStyling: false

                                          });
                                          this.closest('li').remove();
              
                                      } else {
                                          Swal.fire({
                                              icon: 'error',
                                              title: 'Error!',
                                              text: 'Failed to delete the comment.',
                                          });
                                      }
                                  });
                              }
                          });
                      });
                  });
      
                  document.getElementById('commentInput').value = '';
              } else {
                  Swal.fire({
                      icon: 'error',
                      title: 'Hata!',
                      text: 'Yorum eklenirken bir hata oluştu.',
                  });
              }
          })
          .catch(error => {
              Swal.fire({
                  icon: 'error',
                  title: 'Hata!',
                  text: 'Bir hata oluştu.',
              });
              console.error('Yorum ekleme hatası:', error);
          });
      });
      
        /*
        add comment bitis
        */

  
/*
COMMENTT BİTTİ ;(

  */

  function openDetailsModal(taskId) {
    fetch(`/api/task-details/${extractTaskId(taskId)}`)
        .then(response => response.json())
        .then(data => {
            if (!data || data.length === 0) {
                console.log("No data available");
                return;
            }

            const columns = Object.keys(data[0]);

            if ($.fn.DataTable.isDataTable('#detailsTable')) {
                $('#detailsTable').DataTable().clear().destroy();
            }

            const tableHead = document.querySelector('#detailsTable thead');
            const tableBody = document.querySelector('#detailsTable tbody');
            tableHead.innerHTML = '';
            tableBody.innerHTML = '';

            const headerRow = document.createElement('tr');
            columns.forEach(col => {
                const th = document.createElement('th');
                th.textContent = col;
                headerRow.appendChild(th);
            });
            tableHead.appendChild(headerRow);

            const tableData = data.map(row => {
                const formattedRow = {};
                columns.forEach(col => {
                    formattedRow[col] = row[col];
                });
                return formattedRow;
            });

            $('#detailsTable').DataTable({
                scrollY: '300px',
                scrollCollapse: true,
                paging: true,
                data: tableData,
                columns: columns.map(col => ({
                    title: col,
                    data: col
                })),
                destroy: true
            });

        })
        .catch(error => {
            console.error('Error fetching task details:', error);
        });
}

  

  /*
  TAG USER FORM GONDERME
  */
  document.getElementById('AddUserAsignModal').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    
    fetch('/kanban/assignuser', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toastr.success("Kullanıcı başarıyla task'a eklendi!");
        } else if (data.error) {
            toastr.error("Kullanıcı eklenemedi, lütfen yönetici ile görüşünüz!");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred.');
    });
});

/*
TAG USER FORM GONDERME BİTİS
*/





})();
