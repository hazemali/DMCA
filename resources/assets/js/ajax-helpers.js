
(function(){



	var submitAjaxRequest = function(e){

		var form = $(this);

		var method = form.find('input[name="_method"]').val() || 'POST';

		$.ajax({

			type : method,

			data : form.serialize(),

			url : form.prop('action'),

			success: function(){

				$.publish('form.submitted',form);
			}



		});


		e.preventDefault();

	}


	$('form[data-remote]').on('submit',submitAjaxRequest);

	$('*[data-click-submits-form]').on('change',function(){
		$(this).closest('form').submit();
	})


})();