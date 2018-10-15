/*
* $ Simply Countable plugin
* Provides a character counter for any text input or textarea
*
* @version  0.4.2
* @homepage http://github.com/aaronrussell/$-simply-countable/
* @author   Aaron Russell (http://www.aaronrussell.co.uk)
*
* Copyright (c) 2009-2010 Aaron Russell (aaron@gc4.co.uk)
* Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
* and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
*/

/**
 * Edit by: Eyal Ron, Divine Sites
 * how to use: call the function valueCounter() - see function definition for more options
 */

(function($){

  $.fn.simplyCountable = function(options){

    options = $.extend({
      counter:            '#counter',
      countType:          'characters',
      maxCount:           140,
      strictMax:          false,
      countDirection:     'down',
      safeClass:          'safe',
      overClass:          'over',
      thousandSeparator:  ',',
      onOverCount:        function(){},
      onSafeCount:        function(){},
      onMaxCount:         function(){}
    }, options);

    var navKeys = [33,34,35,36,37,38,39,40];

    return $(this).each(function(){

      var countable = $(this);
      var counter = $(options.counter);
      if (!counter.length) { return false; }

      var countCheck = function(){

        var count;
        var revCount;

        var reverseCount = function(ct){
          return ct - (ct*2) + options.maxCount;
        }

        var countInt = function(){
          return (options.countDirection === 'up') ? revCount : count;
        }

        var numberFormat = function(ct){
          var prefix = '';
          if (options.thousandSeparator){
            ct = ct.toString();
            // Handle large negative numbers
            if (ct.match(/^-/)) {
              ct = ct.substr(1);
              prefix = '-';
            }
            for (var i = ct.length-3; i > 0; i -= 3){
              ct = ct.substr(0,i) + options.thousandSeparator + ct.substr(i);
            }
          }
          return prefix + ct;
        }

        var changeCountableValue = function(val){
          countable.val(val).trigger('change');
        }

        /* Calculates count for either words or characters */
        if (options.countType === 'words'){
          count = options.maxCount - $.trim(countable.val()).split(/\s+/).length;
          if (countable.val() === ''){ count += 1; }
        }
        else { count = options.maxCount - countable.val().length; }
        revCount = reverseCount(count);

        /* If strictMax set restrict further characters */
        if (options.strictMax && count <= 0){
          var content = countable.val();
          if (count < 0) {
            options.onMaxCount(countInt(), countable, counter);
          }
          if (options.countType === 'words'){
            var allowedText = content.match( new RegExp('\\s?(\\S+\\s+){'+ options.maxCount +'}') );
            if (allowedText) {
              changeCountableValue(allowedText[0]);
            }
          }
          else { changeCountableValue(content.substring(0, options.maxCount)); }
          count = 0, revCount = options.maxCount;
        }

        counter.text(numberFormat(countInt()));

        /* Set CSS class rules and API callbacks */
        if (!counter.hasClass(options.safeClass) && !counter.hasClass(options.overClass)){
          if (count < 0){ counter.addClass(options.overClass); }
          else { counter.addClass(options.safeClass); }
        }
        else if (count < 0 && counter.hasClass(options.safeClass)){
          counter.removeClass(options.safeClass).addClass(options.overClass);
          options.onOverCount(countInt(), countable, counter);
        }
        else if (count >= 0 && counter.hasClass(options.overClass)){
          counter.removeClass(options.overClass).addClass(options.safeClass);
          options.onSafeCount(countInt(), countable, counter);
        }

      };

      countCheck();

      countable.on('keyup blur paste', function(e) {
        switch(e.type) {
          case 'keyup':
            // Skip navigational key presses
            if ($.inArray(e.which, navKeys) < 0) { countCheck(); }
            //change counter graph width and color
            countCheckColors(options.counter,options.maxCount);
            break;
          case 'paste':
            // Wait a few miliseconds if a paste event
            setTimeout(countCheck, (e.type === 'paste' ? 5 : 0));
            //change counter graph width and color
            countCheckColors(options.counter,options.maxCount);
            break;
          default:
            countCheck();
            break;
        }
      });

    });

  };



})(jQuery);

/**
 * set input element to run the words counter check
 * @param  {jQuery selector}  elementID
 * @param  {int}  maxCount                                        the number of words/chars limit
 * @param  {String}  [prependText=' ']            text to be prepend to the counter number
 * @param  {String}  [appendText=' ']            text to be append to the counter number
 * @param  {String}  [countType='words']                             counter type: words/characters
 * @param  {Boolean} [strictMax=false]                               set to true to strict the input text to maxCount limit
 * @param  {String}  [countDirection='up']                           the direction of the counting: up/down
 * use example: valueCounter('#form-field-field_2', 7, 'מספר מילים');
 */
function valueCounter(elementID, maxCount, prependText=' ', appendText=' ', countType='words', strictMax=false, countDirection='up'){
  var counterSelector = elementID+'_counter'
  counterSelector = counterSelector.substring(1);
  console.log( 'add limit validation for: '+elementID + ', limit to: '+maxCount +' '+ countType );

  jQuery(elementID).parent().append('<div class="counterGraph"></div><div class="counter-wrapper">'+prependText+' &nbsp;<span dir="ltr" class="counter '+counterSelector+'">0</span>&nbsp;'+appendText+'</div>');
  jQuery(elementID).focus(function(){
      jQuery(elementID).parent().find('.counter-wrapper').slideDown();
    }).blur(function(){
      jQuery(elementID).parent().find('.counter-wrapper').slideUp();
    });
  jQuery(elementID).simplyCountable({
      counter:            '.'+counterSelector,
      countType:          countType,
      maxCount:           maxCount,
      strictMax:          strictMax,
      countDirection:     countDirection,
      safeClass:          'safe',
      overClass:          'over',
      thousandSeparator:  ',',
      onOverCount:        function(count, countable, counter){
    },
      onSafeCount:        function(count, countable, counter){

    },
      onMaxCount:         function(count, countable, counter){}
  });
}
function countCheckColors(counter, maxCount){
  var counter_percent = parseInt((jQuery(counter).text() / maxCount)*100);
  var graphSize = counter_percent;
  if(graphSize > 100){
    graphSize = 100;
  }
  jQuery(counter).parent().parent().find('.counterGraph').css('width',graphSize+'%');

  // change counter graph state by percentage - colors defined by css selectors: .counterGraph, .badCount, .midCount, .goodCount, .perfectCount,
  if(counter_percent > 20 && counter_percent <= 40){
    jQuery(counter).parent().parent().find('.counterGraph').addClass('badCount').removeClass('midCount');
  }else if(counter_percent > 40 && counter_percent <= 60){
    jQuery(counter).parent().parent().find('.counterGraph').addClass('midCount').removeClass('badCount goodCount');
  }else if(counter_percent > 60 && counter_percent <= 80){
    jQuery(counter).parent().parent().find('.counterGraph').addClass('goodCount').removeClass('midCount perfectCount');
  }else if(counter_percent > 80 && counter_percent <= 100){
    jQuery(counter).parent().parent().find('.counterGraph').addClass('perfectCount').removeClass('goodCount');
  }else{
    jQuery(counter).parent().parent().find('.counterGraph').removeClass('badCount midCount goodCount perfectCount');
  }
}
