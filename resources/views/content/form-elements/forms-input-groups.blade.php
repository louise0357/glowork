@extends('layouts/layoutMaster')

@section('title', 'Input groups - Forms')

@section('page-script')
@vite('resources/assets/js/form-input-group.js')
@endsection

@section('content')
<div class="row">
  <!-- Floating (Outline) -->
  <div class="col-md-6">
    <div class="card mb-6">
      <h5 class="card-header">Floating (Outline)</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">
        <div class="form-floating form-floating-outline">
          <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
            <option>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
          <label for="floatingSelect">Works with selects</label>
        </div>

        <div class="input-group input-group-merge">
          <span class="input-group-text">@</span>
          <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="basic-addon11" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon11" />
            <label for="basic-addon11">Username</label>
          </div>
        </div>

        <div class="form-password-toggle">
          <div class="input-group input-group-merge">
            <div class="form-floating form-floating-outline">
              <input type="password" class="form-control" id="basic-default-password12" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password12" />
              <label for="basic-default-password12">Password</label>
            </div>
            <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line ri-20px"></i></span>
          </div>
        </div>

        <div class="input-group input-group-merge">
          <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="basic-addon13" placeholder="john.doe" aria-label="Recipient's username" aria-describedby="basic-addon13" />
            <label for="basic-addon13">Recipient's username</label>
          </div>
          <span class="input-group-text">@example.com</span>
        </div>

        <div class="input-group input-group-merge">
          <span class="input-group-text">https://example.com/users/</span>
          <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" placeholder="id" id="basic-url14" aria-describedby="basic-url14" />
            <label for="basic-url14">URL</label>
          </div>
        </div>

        <div class="input-group input-group-merge">
          <span class="input-group-text">$</span>
          <div class="form-floating form-floating-outline">
            <input type="number" class="form-control" placeholder="499" aria-label="Amount (to the nearest dollar)" />
            <label>Amount</label>
          </div>
          <span class="input-group-text">.00</span>
        </div>

        <div class="input-group input-group-merge">
          <span class="input-group-text">With textarea</span>
          <div class="form-floating form-floating-outline">
            <textarea class="form-control h-px-75" aria-label="With textarea" placeholder="Lorem ipsum"></textarea>
            <label>Comment</label>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Floating (Filled) -->
  <div class="col-md-6">
    <div class="card mb-6">
      <h5 class="card-header">Floating (Filled)</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">

        <div class="form-floating">
          <select class="form-select" id="floatingSelectFilled" aria-label="Floating label select example">
            <option>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
          <label for="floatingSelectFilled">Works with selects</label>
          <span class="form-floating-focused"></span>
        </div>

        <div class="input-group input-group-floating">
          <span class="input-group-text">@</span>
          <div class="form-floating">
            <input type="text" class="form-control" id="basic-addon21" placeholder="John Doe" aria-label="Username" aria-describedby="basic-addon21" />
            <label for="basic-addon21">Username</label>
          </div>
          <span class="form-floating-focused"></span>
        </div>

        <div class="form-password-toggle">
          <div class="input-group input-group-floating">
            <div class="form-floating">
              <input type="password" class="form-control" id="basic-default-password22" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password22" />
              <label for="basic-default-password22">Password</label>
            </div>
            <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line ri-20px"></i></span>
            <span class="form-floating-focused"></span>
          </div>
        </div>

        <div class="input-group input-group-floating">
          <div class="form-floating">
            <input type="text" class="form-control" id="basic-addon23" placeholder="john.doe" aria-label="Recipient's username" aria-describedby="basic-addon23" />
            <label for="basic-addon23">Recipient's username</label>
          </div>
          <span class="input-group-text">@example.com</span>
          <span class="form-floating-focused"></span>
        </div>

        <div class="input-group input-group-floating">
          <span class="input-group-text">https://example.com/users/</span>
          <div class="form-floating">
            <input type="text" class="form-control" id="basic-url24" placeholder="id" aria-describedby="basic-url24" />
            <label for="basic-url24">URL</label>
          </div>
          <span class="form-floating-focused"></span>
        </div>

        <div class="input-group input-group-floating">
          <span class="input-group-text">$</span>
          <div class="form-floating">
            <input type="number" class="form-control" placeholder="499" aria-label="Amount (to the nearest dollar)" />
            <label>Amount</label>
          </div>
          <span class="input-group-text">.00</span>
          <span class="form-floating-focused"></span>
        </div>

        <div class="input-group input-group-floating">
          <span class="input-group-text">With textarea</span>
          <div class="form-floating">
            <textarea class="form-control h-px-75" aria-label="With textarea" placeholder="Lorem ipsum"></textarea>
            <label>Comment</label>
          </div>
          <span class="form-floating-focused"></span>
        </div>

      </div>
    </div>
  </div>

  <!-- Merged -->
  <div class="col-md-6">
    <div class="card mb-6">
      <h5 class="card-header">Merged</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">

        <div class="input-group input-group-merge">
          <span class="input-group-text" id="basic-addon-search31"><i class="ri-search-line ri-20px"></i></span>
          <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" />
        </div>

        <div class="form-password-toggle">
          <label class="form-label" for="basic-default-password32">Password</label>
          <div class="input-group input-group-merge">
            <input type="password" class="form-control" id="basic-default-password32" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password32" />
            <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line ri-20px"></i></span>
          </div>
        </div>

        <div class="input-group input-group-merge">
          <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon33" />
          <span class="input-group-text" id="basic-addon33">@example.com</span>
        </div>

        <div class="input-group input-group-merge">
          <span class="input-group-text" id="basic-addon34">https://example.com/users/</span>
          <input type="text" class="form-control" id="basic-url3" aria-describedby="basic-addon34" />
        </div>

        <div class="input-group input-group-merge">
          <span class="input-group-text">$</span>
          <input type="number" class="form-control" placeholder="100" aria-label="Amount (to the nearest dollar)" />
          <span class="input-group-text">.00</span>
        </div>

        <div class="input-group input-group-merge">
          <span class="input-group-text">With textarea</span>
          <textarea class="form-control" aria-label="With textarea" style="height: 60px;"></textarea>
        </div>

      </div>
    </div>
  </div>

  <!-- Basic -->
  <div class="col-md-6">
    <div class="card mb-6">
      <h5 class="card-header">Basic</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">

        <div class="input-group">
          <span class="input-group-text" id="basic-addon41">@</span>
          <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon41" />
        </div>

        <div class="form-password-toggle">
          <label class="form-label" for="basic-default-password42">Password</label>
          <div class="input-group">
            <input type="password" class="form-control" id="basic-default-password42" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password42" />
            <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line ri-20px"></i></span>
          </div>
        </div>

        <div class="input-group">
          <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon43" />
          <span class="input-group-text" id="basic-addon43">@example.com</span>
        </div>

        <div class="input-group">
          <span class="input-group-text" id="basic-addon44">https://example.com/users/</span>
          <input type="text" class="form-control" placeholder="URL" id="basic-url441" aria-describedby="basic-addon44" />
        </div>

        <div class="input-group">
          <span class="input-group-text">$</span>
          <input type="number" class="form-control" placeholder="Amount" aria-label="Amount (to the nearest dollar)" />
          <span class="input-group-text">.00</span>
        </div>

        <div class="input-group">
          <span class="input-group-text">With textarea</span>
          <textarea class="form-control" aria-label="With textarea" placeholder="Comment" style="height: 60px;"></textarea>
        </div>

      </div>
    </div>
  </div>

  <!-- Sizing -->
  <div class="col-md-6">
    <div class="card mb-6">
      <h5 class="card-header">Sizing & Shape</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">

        <div class="input-group input-group-lg">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" placeholder="Username" />
        </div>

        <div class="input-group">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" placeholder="Username" />
        </div>

        <div class="input-group input-group-sm">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" placeholder="Username" />
        </div>

        <div class="input-group input-group-merge input-group-lg">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" placeholder="Username" />
        </div>

        <div class="input-group input-group-merge">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" placeholder="Username" />
        </div>

        <div class="input-group input-group-merge input-group-sm">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" placeholder="Username" />
        </div>
      </div>
      <hr class="m-0" />
      <div class="card-body">
        <div class="input-group rounded-pill">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" placeholder="Username" />
        </div>
      </div>
    </div>
  </div>
  <!-- Checkbox and radio addons -->
  <div class="col-md-6">
    <div class="card mb-6">
      <h5 class="card-header">Checkbox and radio addons</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">
        <div class="input-group">
          <div class="input-group-text form-check mb-0">
            <input class="form-check-input m-auto" type="checkbox" value="" aria-label="Checkbox for following text input">
          </div>
          <input type="text" class="form-control" aria-label="Text input with checkbox">
        </div>
        <div class="input-group">
          <div class="input-group-text form-check mb-0">
            <input class="form-check-input m-auto" type="radio" value="" aria-label="Radio button for following text input">
          </div>
          <input type="text" class="form-control" aria-label="Text input with radio button">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Multiple inputs & addon -->
  <div class="col-md-6">
    <div class="card mb-6">
      <h5 class="card-header">Multiple inputs & addon</h5>

      <div class="card-body demo-vertical-spacing demo-only-element">
        <small class="text-light fw-medium d-block">Multiple inputs</small>
        <div class="input-group">
          <span class="input-group-text">First and last name</span>
          <input type="text" aria-label="First name" class="form-control">
          <input type="text" aria-label="Last name" class="form-control">
        </div>

        <small class="text-light fw-medium d-block pt-4">Multiple addons</small>
        <div class="input-group">
          <span class="input-group-text">$</span>
          <span class="input-group-text">0.00</span>
          <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
        </div>

        <div class="input-group">
          <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
          <span class="input-group-text">$</span>
          <span class="input-group-text">0.00</span>
        </div>
      </div>

    </div>
  </div>
  <!-- Speech To Text -->
  <div class="col-md-6">
    <div class="card mb-6">
      <h5 class="card-header">Speech To Text</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">

        <small class="text-light fw-medium d-block">Input Group</small>

        <div class="input-group input-group-merge form-send-message">
          <input type="text" class="form-control message-input" placeholder="Say it" aria-describedby="text-to-speech-addon">
          <span class="message-actions input-group-text" id="text-to-speech-addon">
            <i class="ri-mic-line ri-20px cursor-pointer speech-to-text"></i>
          </span>
        </div>

        <small class="text-light fw-medium d-block pt-4">Textarea</small>

        <div class="input-group input-group-merge form-send-message">
          <textarea class="form-control message-input" placeholder="Say it" rows="2"></textarea>
          <span class="message-actions input-group-text">
            <i class='ri-mic-line ri-20px cursor-pointer speech-to-text'></i>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Button with dropdowns & addons -->
<div class="row">
  <div class="col-md-6">
    <div class="card mb-6">
      <h5 class="card-header">Button with dropdowns & addons</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">
        <small class="text-light fw-medium d-block">Button addons</small>
        <div class="input-group">
          <button class="btn btn-outline-primary" type="button" id="button-addon1">Button</button>
          <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
        </div>

        <div class="input-group">
          <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
          <button class="btn btn-outline-primary" type="button" id="button-addon2">Button</button>
        </div>

        <div class="input-group">
          <button class="btn btn-outline-primary" type="button">Button</button>
          <button class="btn btn-outline-primary" type="button">Button</button>
          <input type="text" class="form-control" placeholder="" aria-label="Example text with two button addons">
        </div>

        <div class="input-group">
          <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username with two button addons">
          <button class="btn btn-outline-primary" type="button">Button</button>
          <button class="btn btn-outline-primary" type="button">Button</button>
        </div>

        <small class="text-light fw-medium d-block pt-4">Button with dropdowns</small>
        <div class="input-group">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
          </ul>
          <input type="text" class="form-control" aria-label="Text input with dropdown button">
        </div>

        <div class="input-group">
          <input type="text" class="form-control" aria-label="Text input with dropdown button">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
          </ul>
        </div>

        <div class="input-group">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:void(0);">Action before</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Another action before</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
          </ul>
          <input type="text" class="form-control" aria-label="Text input with 2 dropdown buttons">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>

  <div class="col-md-6">

    <!-- Segmented buttons -->
    <div class="row">
      <div class="col-12">
        <div class="card mb-6">
          <h5 class="card-header">Segmented buttons</h5>
          <div class="card-body demo-vertical-spacing demo-only-element">
            <div class="input-group">
              <button type="button" class="btn btn-outline-primary">Action</button>
              <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
              </ul>
              <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
            </div>

            <div class="input-group">
              <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
              <button type="button" class="btn btn-outline-primary">Action</button>
              <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Custom select -->
    <div class="row">
      <div class="col-12">
        <div class="card mb-6">
          <h5 class="card-header">Custom select</h5>
          <div class="card-body demo-vertical-spacing demo-only-element">
            <div class="input-group">
              <label class="input-group-text" for="inputGroupSelect01">Options</label>
              <select class="form-select" id="inputGroupSelect01">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>

            <div class="input-group">
              <select class="select2 form-select" id="inputGroupSelect02" multiple>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
              <label class="input-group-text" for="inputGroupSelect02">
                <button class="btn btn-outline-primary" type="button">Button</button>
            </label>
            </div>

            <div class="input-group">
              <button class="btn btn-outline-primary" type="button">Button</button>
              <select class="form-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>

            <div class="input-group">
              <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
              <button class="btn btn-outline-primary" type="button">Button</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Custom file input -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <h5 class="card-header">Custom file input</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">
        <div class="input-group">
          <label class="input-group-text" for="inputGroupFile01">Upload</label>
          <input type="file" class="form-control" id="inputGroupFile01">
        </div>

        <div class="input-group">
          <input type="file" class="form-control" id="inputGroupFile02">
          <label class="input-group-text" for="inputGroupFile02">Upload</label>
        </div>

        <div class="input-group">
          <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon03">Button</button>
          <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
        </div>

        <div class="input-group">
          <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
          <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon04">Button</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
