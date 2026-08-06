
@for ($i=0; $i <3; $i++)
<div
  tabindex="{{ $i }}"
  class="bg-gray-300 text-primary-content hover:bg-green-800 hover:text-white collapse hover:collapse-open rounded-none"
>
  <div class="collapse-title font-semibold ">How do I create an account?</div>
  <div class="collapse-content text-sm">
    Click the "Sign Up" button in the top right corner and follow the registration process.
  </div>
</div>
@endfor