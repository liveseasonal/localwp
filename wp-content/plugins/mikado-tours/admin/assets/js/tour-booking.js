window.mkdfBooking = (function($) {
	'use strict';

	$(document).ready(function() {
		tourBooking.rowRepeater.init();
		tourBooking.timeRepeater.init();
		savePeriods.init();
		fieldsHelper.datepicker.initDatepickers();
	});

	var tourBooking = function() {
		var $bookingContent = $('#mkdf-tour-booking-content'),
			numberOfRows = $bookingContent.find('.mkdf-tour-booking-section').length;

		var rowRepeater = function() {
			var bookingTemplate = wp.template('mkdf-tour-booking-template');
			var $addButton = $('#mkdf-tour-booking-add');

			var addNewPeriod = function() {
				$addButton.on('click', function(e) {
					e.preventDefault();
					e.stopPropagation();

					$(document).trigger('mkdf_tour_booking/before_add_period');

					var $row = $(bookingTemplate({
						rowIndex: getLastRowIndex() + 1 || 0
					}));

					$bookingContent.append($row);

					numberOfRows += 1;

					fieldsHelper.datepicker.initDatepickers($row);

					$(document).trigger('mkdf_tour_booking/after_add_period');
				});
			};

			var removePeriod = function() {
				$bookingContent.on('click', '.mkdf-tour-booking-remove-item', function(e) {
					e.preventDefault();
					e.stopPropagation();

					if(!window.confirm('Are you sure you want to remove this section?')) {
						return;
					}

					var $rowParent = $(this).parents('.mkdf-tour-booking-section');
					$rowParent.remove();

					decrementNumberOfRows();

					$(document).trigger('mkdf_tour_booking/after_delete_period');
				});
			};

			var getLastRowIndex = function() {
				var $lastRow = $bookingContent.find('.mkdf-tour-booking-section').last();

				if(typeof $lastRow === 'undefined') {
					return false;
				}

				return $lastRow.data('index');
			};

			var decrementNumberOfRows = function() {
				if(numberOfRows <= 0) {
					return;
				}

				numberOfRows -= 1;
			}

			var getNumberOfRows = function() {
				return numberOfRows;
			}

			return {
				init: function() {
					addNewPeriod();
					removePeriod();
				},
				numberOfRows: getNumberOfRows,
				getLastRowIndex: getLastRowIndex,
			}
		}();

		var timeRepeater = function() {
			var timeTemplate = wp.template('mkdf-tour-booking-time-template');

			var addNewTime = function() {
				$bookingContent.on('click', '.mkdf-tour-booking-time-add', function(e) {
					e.preventDefault();
					e.stopPropagation();

					var $clickedButton = $(this);
					var $parentRow = $clickedButton.parents('.mkdf-tour-booking-section').first();
					var parentIndex = $parentRow.data('index');

					var $timeContent = $clickedButton.prev();

					var lastTimeIndex = $parentRow.find('.mkdf-tour-booking-time').last().data('index');
					lastTimeIndex = typeof lastTimeIndex !== 'undefined' ? lastTimeIndex : -1;

					var $timeRow = $(timeTemplate({
						rowIndex: parentIndex,
						timeIndex: lastTimeIndex + 1
					}));

					$timeContent.append($timeRow);
				});
			};

			var removeTime = function() {
				$bookingContent.on('click', '.mkdf-tour-booking-time-remove', function(e) {
					e.preventDefault();
					e.stopPropagation();

					if(!confirm('Are you sure you want to remove departure time?')) {
						return;
					}

					var $removeButton = $(this);
					var $parent = $removeButton.parents('.mkdf-tour-booking-time');

					$parent.remove();
				});
			};

			return {
				init: function() {
					addNewTime();
					removeTime();
				}
			}
		}();

		return {
			rowRepeater: rowRepeater,
			timeRepeater: timeRepeater,
			$bookingContent: $bookingContent
		}
	}();

	var savePeriods = function() {
		var $saveButton = $('#mkdf-tour-booking-save');
		var validationTemplate = wp.template('mkdf-tour-booking-validation');
		var tourBookingMessageTemplate = wp.template('mkdf-tour-booking-save-message');
		var $tourBookingMessageHolder = $('#mkdf-tour-booking-messages');

		var saveButtonVisibility = function() {
			var decideVisiblity = function() {
				var visible = false;

				if(tourBooking.rowRepeater.numberOfRows() > 0) {
					visible = true;
				}

				$saveButton.css({display: visible ? 'inline-block' : 'none'})
			};

			decideVisiblity();

			$(document).on('mkdf_tour_booking/after_add_period mkdf_tour_booking/after_delete_period', decideVisiblity);
		};

		var handleFormSaving = function() {
			$saveButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();

				$tourBookingMessageHolder.empty();

				var loadingLabel = $saveButton.data('loading-label');
				var originalText = $saveButton.text();
				var data = {
					action: 'save_tour_booking'
				};

				data.periods = tourBooking.$bookingContent.find('input, select, textarea').serialize();
				data.nonce = $('[name*="mkdf_tours_saving_tour_periods"]').val();
				data.tour_id = $('#tour_id').val();

				if(!formValidation.isFormValid()) {
					return false;
				}
				
				$saveButton.text(loadingLabel);

				$.ajax({
					url: MikadofToursAjaxUrl.url,
					data: data,
					type: 'POST',
					dataType: 'json',
					success: function(value) {
						$saveButton.text(originalText);

						$tourBookingMessageHolder.append(
							tourBookingMessageTemplate({
								message: value.message,
								htmlClass: value.status ? 'alert-success' : 'alert-danger'
							})
						);
					}
				});
			});
		};

		var formValidation = function() {
			var validationMessages = [];

			var isFormValid = function() {
				var $rows = tourBooking.$bookingContent.find('.mkdf-tour-booking-section');

				//reset validation messages if we had any errors previously
				validationMessages = [];

				if(!$rows.length) {
					return false;
				}

				$rows.each(function() {
					var rowValidationMessages = [];

					var $thisRow = $(this);
					var startDateVal = $thisRow.find('[name*="start_date"]').val();
					var endDateVal = $thisRow.find('[name*="end_date"]').val();
					var $days = $thisRow.find('[name*="days"]:checked');
					var numOfTickets = $thisRow.find('[name*="number_of_tickets"]').val();
					var $emptyTimeFields = $thisRow.find('[name*="tour_time"]').filter(function() {
						return !$(this).val();
					});

					console.log($emptyTimeFields);

					if(!startDateVal) {
						rowValidationMessages.push("Please provide valid stard date");
					}

					if(!endDateVal) {
						rowValidationMessages.push("Please provide valid end date");
					}

					if(!$days.length) {
						rowValidationMessages.push("Please choose at least one day of the week");
					}

					if(!numOfTickets) {
						rowValidationMessages.push("Please add number of tickets for chosen period");
					}

					if($emptyTimeFields.length) {
						rowValidationMessages.push("Please fill time for added time fields");
					}

					if(rowValidationMessages.length) {
						validationMessages[$thisRow.data('index')] = rowValidationMessages;
					}
				});

				updateValidationTemplate();

				return validationMessages.length === 0;
			}

			var updateValidationTemplate = function() {
				var $rows = tourBooking.$bookingContent.find('.mkdf-tour-booking-section');

				tourBooking.$bookingContent.find('.mkdf-tour-booking-section-validation').empty();

				if(!$rows.length || !validationMessages.length) {
					return false;
				}

				$rows.each(function() {
					var $thisRow = $(this);
					var $rowValidationTemplate = $thisRow.find('.mkdf-tour-booking-section-validation');
					var rowIndex = $thisRow.data('index');
					var rowValidationMessages = validationMessages[rowIndex];

					$rowValidationTemplate.empty();

					if(typeof rowValidationMessages !== 'undefined' && rowValidationMessages.length) {
						$rowValidationTemplate.append(
							validationTemplate({errorMessages: rowValidationMessages})
						);
					}
				});
			};

			return {
				isFormValid: isFormValid,
				updateValidationTemplate: updateValidationTemplate
			}
		}();

		return {
			saveButtonVisibility: saveButtonVisibility,
			formValidation: formValidation,
			init: function() {
				saveButtonVisibility();
				handleFormSaving();
			}
		}
	}();


	var fieldsHelper = function() {
		var datepicker = function() {
			var dateFormat = "MM dd, yy";

			return {
				initDatepickers: function($content) {
					var $searchIn = $content || tourBooking.$bookingContent;
					var $datepickers = $searchIn.find('.datepicker');

					if($datepickers.length) {
						$datepickers.each(function() {
							$(this).datepicker({dateFormat: dateFormat});
						});
					}
				}
			};
		}();

		return {
			datepicker: datepicker
		}
	}();

	//module export
	return {
		tourBooking: tourBooking,
		fieldsHelper: fieldsHelper,
		savePeriods: savePeriods
	};

})(jQuery);