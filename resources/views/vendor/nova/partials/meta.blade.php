<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2232%22 height=%2232%22 viewBox=%220 0 32 32%22>
    <path d=%22M28.443 5.76c-6.365-5.245-15.839-4.917-21.813 0.984-1.932 1.896-3.021 4.49-3.021 7.198s1.089 5.302 3.021 7.198c4.026 3.979 10.552 3.979 14.573 0 1.729-1.693 1.729-4.474 0-6.167-1.729-1.708-4.51-1.708-6.245 0-0.578 0.568-1.505 0.568-2.083 0-0.573-0.568-0.573-1.495 0-2.057 2.891-2.844 7.526-2.844 10.411 0 1.38 1.354 2.156 3.208 2.156 5.141s-0.776 3.786-2.156 5.141c-5.172 5.115-13.563 5.115-18.74 0-2.479-2.432-3.875-5.766-3.88-9.24-0.005-3.479 1.385-6.807 3.859-9.25 2.938-2.906 6.99-4.708 11.474-4.708 5 0 9.474 2.24 12.443 5.76zM27.49 27.271c-3.052 3.036-7.182 4.74-11.49 4.729-4.797 0.010-9.349-2.094-12.443-5.76 6.359 5.245 15.839 4.917 21.813-0.984 1.932-1.896 3.021-4.49 3.021-7.198s-1.089-5.302-3.021-7.198c-4.026-3.979-10.552-3.979-14.573 0-1.729 1.693-1.729 4.474 0 6.167 1.729 1.708 4.51 1.708 6.245 0 0.578-0.568 1.505-0.568 2.083 0 0.573 0.568 0.573 1.495 0 2.057-2.891 2.844-7.526 2.844-10.411 0-1.38-1.354-2.156-3.208-2.156-5.141s0.776-3.786 2.156-5.141c5.172-5.115 13.562-5.115 18.74 0 2.474 2.432 3.875 5.755 3.88 9.224 0.005 3.474-1.375 6.802-3.844 9.245z%22/></svg>" />

<style>
    :root {
        --primary: {{nova_get_setting('main_color', 'red')}} !important;
        --primary-50: {{nova_get_setting('input_fields_active_color', 'red')}} !important;
        --logo: {{nova_get_setting('logo_color', 'red')}} !important;
    }
    /* :root {
        --primary: {{nova_get_setting('primary')}} !important;
        --primary-dark: {{nova_get_setting('primary_dark')}} !important;
        --primary-70: {{nova_get_setting('primary_70')}} !important;
        --primary-50: {{nova_get_setting('primary_50')}} !important;
        --primary-30: {{nova_get_setting('primary_30')}} !important;
        --primary-10: {{nova_get_setting('primary_10')}} !important;
        --logo: {{nova_get_setting('logo_color')}} !important;
        --sidebar-icon:{{nova_get_setting('sidebar_icon')}} !important;
      } */

      .bg-grad-sidebar {
        background: {{nova_get_setting('sidebar')}} !important;
      }

      .btn-primary {
          /* background: #222 !important; */
          background: {{nova_get_setting('confirm_button', 'red')}} !important;
      }

      .form-input-bordered::focus, .form-control::focus, .form-input::focus {
          outline-color: {{nova_get_setting('active_input_border', 'blue')}} !important;
      }
      .card {
          background: {{nova_get_setting('cards_color', 'red')}}} !important;
      }

      .bg-logo, .w-sidebar {
          background: red !important;
      }

</style>
