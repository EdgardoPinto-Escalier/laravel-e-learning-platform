<!-- Here we create the a element that will open the modal modal
Window. Here the teacher will be able to send messages to his students -->
<a href="#" data-target="#appModal"
   title="{{ ('Send Message') }}"
   data-id="{{$user['id']}}"
   class="btn btnSendEmail"
>
   <i class="far fa-envelope fa-lg"></i>
 </a>
