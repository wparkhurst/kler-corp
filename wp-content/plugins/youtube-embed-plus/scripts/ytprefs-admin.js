(function (window, $)
{
    window._EPYTA_.widen_ytprefs_wiz = window._EPYTA_.widen_ytprefs_wiz || function ()
    {
        setTimeout(function ()
        {
            var tbWidth = Math.min(950, $(window).width() - 100);
            var tbMargin = -1 * tbWidth / 2;
            $("#TB_window").addClass('epyt-thickbox').animate({marginLeft: tbMargin, width: tbWidth}, 150, 'swing', function ()
            {
                $("#TB_window").get(0).style.setProperty('width', tbWidth, 'important');
            });

            $("#TB_overlay").addClass('epyt-thickbox');

            $("#TB_window iframe").animate({width: tbWidth}, 150);
        }, 750);
    };

    window._EPYTA_.ytvi_cancel = window._EPYTA_.ytvi_cancel || function ()
    {
        $('.ytvi-step').hide('fade', {}, 500, function ()
        {
            $('.ytvi-step-1').show('fade', {}, 500);
        });
    };

    window._EPYTA_.moneyFormat = window._EPYTA_.moneyFormat || function (num)
    {
        return '$' + parseFloat(num).toFixed(2);
    };

    window._EPYTA_.escId = function (myid)
    {
        return "#" + myid.replace(/(:|\.|\[|\]|,|=|@)/g, "\\$1");
    };

    window._EPYTA_.demoBackgroundColor = function (event, ui)
    {
        setTimeout(function ()
        {
            $('.vi-story-demo--info').css('background-color', $(window._EPYTA_.escId('vi_js_settings[backgroundColor]')).val());
        }, 0);
    };
    window._EPYTA_.demoTextColor = function (event, ui)
    {
        setTimeout(function ()
        {
            $('.vi-story-demo--info *').css('color', $(window._EPYTA_.escId('vi_js_settings[textColor]')).val());
        }, 0);
    };
    window._EPYTA_.demoFontFamily = function ()
    {
        $('.vi-story-demo--title').css('font-family', $(window._EPYTA_.escId('vi_js_settings[font]')).val());
    };
    window._EPYTA_.demoFontSize = function ()
    {
        $('.vi-story-demo--title').css('font-size', $(window._EPYTA_.escId('vi_js_settings[fontSize]')).val() + 'px');
    };

    window._EPYTA_.onboardNext = function ($step)
    {
        $('.ytprefs-ob-step').removeClass('active-step');
        setTimeout(function ()
        {
            window.scrollTo(0, 0);
            $step.next().addClass('active-step');
        }, 600);
    };

    window._EPYTA_.onboardPrev = function ($step)
    {
        $('.ytprefs-ob-step').removeClass('active-step');
        setTimeout(function ()
        {
            window.scrollTo(0, 0);
            $step.prev().addClass('active-step');
        }, 600);
    };

    window._EPYTA_.selectText = function (ele)
    {
        if (document.selection)
        {
            var range = document.body.createTextRange();
            range.moveToElementText(ele);
            range.select();
        }
        else if (window.getSelection)
        {
            var selection = window.getSelection();
            var range = document.createRange();
            range.selectNode(ele);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    };

    window._EPYTA_.adstxtLookup = function ()
    {
        window._EPYTA_.adstxtLoading(true);

        $.ajax({
            url: location.protocol + "//" + location.hostname + "/ads.txt?c=" + Date.now(),
            dataType: 'text',
            type: 'get',
            data: '',
            headers: {
                'Cache-Control': 'no-cache'
            },
            async: true
        }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown)
        {
            if (textStatus === 'success')
            {
                var jqXHR = jqXHR_errorThrown;
                var data = data_jqXHR;
                switch (jqXHR.status)
                {
                    case 200:
                    case 301:
                    case 302:
                    case 304:
                    case 307:
                        window._EPYTA_.adstxtVerify(data);
                        break;
                    default:
                        window._EPYTA_.adstxtVerify('');
                        break;
                }
            }
            else
            {
                var jqXHR = data_jqXHR;
                var errorThrown = jqXHR_errorThrown;
                if (jqXHR.status == 404)
                {
                    // retry
                    $.ajax({
                        url: location.protocol + "//" + location.hostname + "/ads.txt",
                        dataType: 'text',
                        type: 'get',
                        data: '',
                        headers: {
                            'Cache-Control': 'no-cache'
                        },
                        async: true
                    }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown)
                    {
                        if (textStatus === 'success')
                        {
                            var jqXHR = jqXHR_errorThrown;
                            var data = data_jqXHR;
                            switch (jqXHR.status)
                            {
                                case 200:
                                case 301:
                                case 302:
                                case 304:
                                case 307:
                                    window._EPYTA_.adstxtVerify(data);
                                    break;
                                default:
                                    window._EPYTA_.adstxtVerify('');
                                    break;
                            }
                        }
                        else
                        {
                            window._EPYTA_.adstxtVerify('');
                        }
                    }
                    );
                }
                else
                {
                    window._EPYTA_.adstxtVerify('');
                }
            }
        });
    };

    window._EPYTA_.adstxtVerify = function (current_adstxt)
    {
        $.ajax({
            type: "post",
            dataType: "json",
            timeout: 120000,
            url: window._EPYTA_.wpajaxurl,
            data: {
                security: window._EPYTA_.security,
                action: 'my_embedplus_vi_adstxt_status_soft_ajax',
                current_adstxt: current_adstxt
            },
            success: function (response)
            {
                if (response.code == 2)
                {
                    $('.nav-tab-adstxt').addClass('nav-tab-valid');
                }
                else if (response.code <= 0)
                {
                    $('.nav-tab-adstxt').addClass('nav-tab-invalid');
                }
                $('.adstxt-verify-message').html(response.message);
            },
            error: function (xhr, ajaxOptions, thrownError)
            {
                $('.nav-tab-adstxt').addClass('nav-tab-invalid');
                $('.adstxt-verify-message').html('Could not validate ads.txt: ' + thrownError);
            },
            complete: function ()
            {
                window._EPYTA_.adstxtLoading(false);
            }
        });
    };

    window._EPYTA_.adstxtLoading = function (show)
    {
        if (show)
        {
            $('.nav-tab-adstxt').addClass('nav-tab-loading');
        }
        else
        {
            $('.nav-tab-adstxt').removeClass('nav-tab-loading');
        }
    };

    window._EPYTA_.gbPreviewSetup = function ()
    {
        window._EPADashboard_.loadYTAPI();
        window._EPADashboard_.apiInit();
        window._EPADashboard_.log("YT API GB");
        window._EPADashboard_.pageReady();
        jQuery('body').fitVidsEP();
    };

    window._EPYTA_.iabAdd = function (iabVal, iabText, iabTextParent)
    {
        var tagText = $('<div class="iab-cat-tag-button" data-tag="' + iabVal + '">' + iabTextParent + ' : ' + iabText + ' &times;</div>');
        $('.iab-cat-tags-display').append(tagText);
        $('.iab-cat-tags-display .iab-cat-tag-button').sort(function (a, b)
        {
            return $(a).text() > $(b).text() ? 1 : -1;
        }).appendTo('.iab-cat-tags-display');
    };

    $.fn.ytprefsFormJSON = function ()
    {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function ()
        {
            if (o[this.name])
            {
                if (!o[this.name].push)
                {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            }
            else
            {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    $(document).ready(function ()
    {

        if (window.location.toString().indexOf('https://') === 0)
        {
            window._EPYTA_.wpajaxurl = window._EPYTA_.wpajaxurl.replace("http://", "https://");
        }
        // Create IE + others compatible event handler
        var epeventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var epeventer = window[epeventMethod];
        var epmessageEvent = epeventMethod === "attachEvent" ? "onmessage" : "message";
        // Listen to message from child window
        epeventer(epmessageEvent, function (e)
        {
            var embedcode = "";
            try
            {
                if (e.data.indexOf("youtubeembedplus") === 0 && e.data.indexOf('clientId=') < 0)
                {
                    embedcode = e.data.split("|")[1];
                    if (embedcode.indexOf("[") !== 0)
                    {
                        embedcode = "<p>" + embedcode + "</p>";
                    }

                    if (window.tinyMCE !== null && window.tinyMCE.activeEditor !== null && !window.tinyMCE.activeEditor.isHidden())
                    {
                        if (window._EPYTA_.mceBookmark)
                        {
                            try
                            {
                                window.tinyMCE.activeEditor.selection.moveToBookmark(window._EPYTA_.mceBookmark);
                            }
                            catch (err)
                            {
                            }
                        }

                        if (typeof window.tinyMCE.execInstanceCommand !== 'undefined')
                        {
                            window.tinyMCE.execInstanceCommand(
                                    window.tinyMCE.activeEditor.id,
                                    'mceInsertContent',
                                    false,
                                    embedcode);
                        }
                        else
                        {
                            send_to_editor(embedcode);
                        }

                        setTimeout(function ()
                        {
                            window._EPYTA_.mceBookmark = null;
                        }, 500);
                    }
                    else
                    {
                        embedcode = embedcode.replace('<p>', '\n').replace('</p>', '\n');
                        if (typeof QTags.insertContent === 'function')
                        {
                            QTags.insertContent(embedcode);
                        }
                        else
                        {
                            send_to_editor(embedcode);
                        }
                    }
                    tb_remove();
                }
            }
            catch (err)
            {

            }
        }, false);

        $('body').on('click.tbyt', "#ytprefs_wiz_button, .ytprefs_wiz_button_widget_text, .ytprefs-onboarding-launch", function ()
        {
            window._EPYTA_.widen_ytprefs_wiz();
        });
        $('body').on('click.tbyt', "#ytprefs_wiz_button_vi, .ytprefs_wiz_button_vi_widget_text", function ()
        {
            send_to_editor('<p>[embed-vi-ad]</p>');
        });
        $(window).resize(window._EPYTA_.widen_ytprefs_wiz);

        $(document).on('wp-before-tinymce-init.ytprefs-media_button', function (event, init)
        {
            $media_buttons = $(init.selector).closest('.wp-editor-wrap').find('.wp-media-buttons');
            if (!$media_buttons.find('.ytprefs_media_link').length)
            {
                $media_buttons.append('<a href="' + encodeURI(window._EPYTA_.wizhref) + '" class="thickbox button ytprefs_media_link ytprefs_wiz_button_widget_text" title="Visual YouTube Search Tool and Wizard - For easier embedding"><span></span> YouTube</a>');

                if (window._EPYTA_.manage_options && window._EPYTA_.vi_logged_in)
                {
                    $media_buttons.append('<a class="button ytprefs_vi_embed_shortcode" id="ytprefs_wiz_button_vi" title="Embed vi video ad"><span></span> Video Ad</a>');
                }
            }
        });



        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if ($('.wrap-vi-settings').length)
        {
            window._EPYTA_.adstxtLookup();
        }

        $('.wrap section a[href^="#jump"]').on('click', function (e)
        {
            e.preventDefault();
            var tab = $(this).attr('href');
            $('.nav-tab-wrapper a[href="' + tab + '"]').click();
        });


        $('.ytprefs-ajax-form').on('keypress', function (ev)
        {
            if (ev.which == 13)
            {
                ev.preventDefault();
                $(this).find('.ytprefs-ajax-form--submit:not([disabled])').click();
            }
        });

        $(window).on('hashchange', function ()
        {
            if (window.location.hash.length > 0)
            {
                $section = $('section' + window.location.hash);
                if ($section.length > 0)
                {
                    $section.find('h2').addClass('ytvi-hash-scroll');
                    setTimeout(function ()
                    {
                        $section.find('h2').removeClass('ytvi-hash-scroll');
                    }, 2000);
                }

                $jumper = $('.jumper' + window.location.hash);
                if ($jumper.length > 0)
                {
                    $('.jumper' + window.location.hash + ' + h3.sect').addClass('ytvi-hash-scroll');
                    setTimeout(function ()
                    {
                        $('.jumper' + window.location.hash + ' + h3.sect').removeClass('ytvi-hash-scroll');
                    }, 2000);
                }
            }
        });

        $('.vi-cover-prompt-no').on('click', function ()
        {
            $.ajax({
                type: "post",
                dataType: "json",
                timeout: 120000,
                url: window._EPYTA_.wpajaxurl,
                data: {
                    security: window._EPYTA_.security,
                    action: 'my_embedplus_vi_hide_feature_ajax'
                },
                success: function (response)
                {
                    if (!response || response.type === 'error')
                    {
                        alertify.alert(response.message);
                    }
                    else
                    {
                        if (window != window.top)
                        {
                            window.location.reload();
                        }
                        else
                        {
                            window.top.location.href = response.url;
                        }
                    }
                },
                error: function (xhr, ajaxOptions, thrownError)
                {
                    alertify.alert('Sorry, there was a network error. Please try again, or turn off this feature using the "Hide Monetize Feature" checkbox on the "Defaults" tab of the YouTube settings. If the issue persists, please contact ext@embedplus.com');
                },
                complete: function ()
                {
                }
            });

        });

        $('.vi-cover-prompt-yes').on('click', function ()
        {
            $('.vi-cover-prompt, .vi-cover-clear').fadeOut(500);
            var date = new Date();
            date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
            document.cookie = "vi_cover_prompt_yes=1;expires=" + date.toUTCString() + ";path=" + window._EPYTA_.admin_url;
        });

        $('.vi-cover-prompt-maybe').on('click', function ()
        {
            var date = new Date();
            date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
            document.cookie = "vi_cover_prompt_yes=1;expires=" + date.toUTCString() + ";path=" + window._EPYTA_.admin_url;
            if (window != window.top)
            {
                window.location.reload();
            }
            else
            {
                window.top.location.href = window._EPYTA_.admin_url_ytprefs;
            }
        });

        if ($('.vi-demo-screen').length > 1)
        {
            var demoInterval = setInterval(function ()
            {
                $('.vi-demo-screen-2').toggleClass('demo-hide');
                $('.vi-demo-mobile-caption').toggleClass('demo-hide');
            }, 20000);
        }

        $('.ytvi-step-1--submit-register').on('click', function (ev)
        {

            var regEmail = $.trim($('.ytvi-register-email').val());
            if (!regEmail.length)
            {
                alertify.alert('Please enter your email address.');

            }
            else
            {
                $('.ytvi-step-1--submit-register').prop('disabled', true);
                $('.ytvi-step-1').hide('fade', {}, 500, function ()
                {
                    $('.ytvi-step-2-loading').show('fade', {}, 500, function ()
                    {
                        $.ajax({
                            type: "post",
                            dataType: "json",
                            timeout: 120000,
                            url: window._EPYTA_.wpajaxurl,
                            data: {
                                security: window._EPYTA_.security,
                                action: 'my_embedplus_vi_cache_endpoints_ajax',
                                email: regEmail,
                                domain: window.location.href
                            },
                            success: function (response)
                            {
                                if (response.type == 'success')
                                {
                                    $('.ytvi-step-2 .ytvi-registration iframe').attr('src', response.signupURLParams);
                                    setTimeout(function ()
                                    {
                                        $('.ytvi-step-2-loading').hide('fade', {}, 500, function ()
                                        {
                                            $('.ytvi-step-2').show('fade', {}, 500);
                                        });
                                    }, 3000);

                                    var date_attempt = new Date(), date_expire = new Date();
                                    date_expire.setTime(date_expire.getTime() + (365 * 24 * 60 * 60 * 1000));
                                    document.cookie = "vi_signup_attempt=" + date_attempt.toUTCString() + ";expires=" + date_expire.toUTCString() + ";path=" + window._EPYTA_.admin_url;
                                }
                                else if (response.type === 'error')
                                {
                                    alertify.alert(response.message);
                                    window._EPYTA_.ytvi_cancel();
                                }
                            },
                            error: function (xhr, ajaxOptions, thrownError)
                            {
                                alertify.alert('Sorry, there was a network error. Please try again. If the issue persists, please contact ext@embedplus.com');
                                window._EPYTA_.ytvi_cancel();
                            },
                            complete: function ()
                            {
                                $('.ytvi-step-1--submit-register').prop('disabled', false);
                            }
                        });
                    });
                });
            }
        });

        $('.ytvi-registration--cancel').on('click', function ()
        {
            window._EPYTA_.ytvi_cancel();
        });

        $('.ytvi-step-1--confirm').on('change', function ()
        {
            if ($(this).is(':checked'))
            {
                $('.ytvi-step-1--submit-register').prop('disabled', false);
            }
            else
            {
                $('.ytvi-step-1--submit-register').prop('disabled', true);
            }
        });

        $('.ytvi-step-1--submit-login').on('click', function (ev)
        {

            var loginEmail = $.trim($('.ytvi-login-email').val());
            var loginPassword = $.trim($('.ytvi-password').val());
            var errorMessage = "";

            errorMessage += loginEmail.length ? "" : "Please enter your email address. ";
            errorMessage += loginPassword.length ? "" : "Please enter your vi dashboard password.";

            if (errorMessage.length)
            {
                alertify.alert(errorMessage);

            }
            else
            {
                $('.ytvi-step-1--submit-login').prop('disabled', true);
                $('.ytvi-step-1').hide('fade', {}, 500, function ()
                {
                    $('.ytvi-login-loading').show('fade', {}, 500, function ()
                    {
                        $.ajax({
                            type: "post",
                            dataType: "json",
                            timeout: 12000000,
                            url: window._EPYTA_.wpajaxurl,
                            data: {
                                security: window._EPYTA_.security,
                                action: 'my_embedplus_vi_login_ajax',
                                email: loginEmail,
                                password: loginPassword
                            },
                            success: function (response)
                            {
                                if (response.type === 'error')
                                {
                                    alertify.alert(response.message);
                                    window._EPYTA_.ytvi_cancel();
                                }
                                else
                                {
                                    $('.ytvi-login-loading').hide('fade', {}, 500, function ()
                                    {
                                        document.cookie = 'vi_signup_attempt=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                                        $('.ytvi-login-success-message').html(response.message);
                                        $('.ytvi-login-success').show('fade', {}, 500, function ()
                                        {});
                                    });
                                }

                            },
                            error: function (xhr, ajaxOptions, thrownError)
                            {
                                alertify.alert('Sorry, there was a network error. Please try again. If the issue persists, please contact ext@embedplus.com');
                                window._EPYTA_.ytvi_cancel();
                            },
                            complete: function ()
                            {
                                $('.ytvi-step-1--submit-login').prop('disabled', false);
                            }
                        });
                    });
                });
            }
        });

        $('a.vi-logged-in-goto').each(function ()
        {
            if ($(this).attr('href').indexOf(window.location.pathname + window.location.search) > 0 || window.location.search.indexOf('youtube-my-preferences') > 0)
            {
                $(this).removeAttr('target');
            }
        });

        if ($('.wrap-vi-settings').length)
        {
            $('.vi-how-works').on('click', function ()
            {
                var hash = $(this).data('jump'); // jstab
                $('.nav-tab-wrapper > a[href="' + hash + '"]').click();
            });

            $(document).on('click', '.wrap-vi-settings .nav-tab-wrapper a', function ()
            {
                $a = $(this);
                $('.wrap-vi-settings .nav-tab-wrapper a').removeClass('nav-tab-active');
                $a.addClass('nav-tab-active');
                $('.wrap-vi-settings section').hide();
                $('.wrap-vi-settings section').filter($a.attr('href')).fadeIn(200);
                return false;
            });


            var iabValRaw = $('.iab-cat-tags').val();
            if (iabValRaw.length > 0)
            {
                var iabCurrent = iabValRaw.split(',');
                iabCurrent.forEach(function (iabVal)
                {
                    var iabText = $('.iab-cat-child option[value="' + iabVal + '"]').text();
                    var iabTextParent = $('.iab-cat-parent option[value="' + (iabVal.split('-')[0]) + '"]').text();
                    window._EPYTA_.iabAdd(iabVal, iabText, iabTextParent);
                });
            }

            $('.iab-cat-parent').on('change', function ()
            {
                var iabPrefix = $(this).val();
                $('.iab-cat-child').val(iabPrefix);
                if (iabPrefix == "")
                {
                    $('.iab-cat-child-box').addClass('hidden');
                    $('.iab-cat-child-box select').prop('disabled', true);
                }
                else
                {
                    $('.iab-cat-child-box').removeClass('hidden');
                    $('.iab-cat-child-box select').prop('disabled', false);
                    $('.iab-cat-child option').addClass('hidden');
                    $('.iab-cat-child option[value^="' + iabPrefix + '-"], .iab-cat-child option[value="' + iabPrefix + '"], .iab-cat-child option[value=""]').removeClass('hidden');
                    $('.iab-cat-child-box select').val('');
                }


            });

            $('.iab-cat-child').on('change', function ()
            {
                var iabCurrent = $('.iab-cat-tags').val() ? $('.iab-cat-tags').val().split(',') : [];
                if (iabCurrent.length < 4)
                {
                    var iabVal = $(this).val();
                    var iabText = $(this).find('option:selected').text();
                    var iabTextParent = $('.iab-cat-parent').find('option:selected').text();
                    if (iabVal && iabCurrent.indexOf(iabVal) == -1)
                    {
                        iabCurrent.push(iabVal);
                        $('.iab-cat-tags').val(iabCurrent.join(','));
                        window._EPYTA_.iabAdd(iabVal, iabText, iabTextParent);
                    }
                }
                else
                {
                    alertify.alert('You can choose up to 4 categories maximum. In order to add a new one, you must remove one of the existing ones.');
                }
            });

            $('.iab-cat-tags-display').on('click', '.iab-cat-tag-button', function ()
            {
                var $tag = $(this);
                var iabVal = $tag.data('tag');
                var iabCurrent = $('.iab-cat-tags').val() ? $('.iab-cat-tags').val().split(',') : [];
                iabCurrent = iabCurrent.filter(function (ele)
                {
                    return ele != iabVal;
                });
                $('.iab-cat-tags').val(iabCurrent.join(','));
                $tag.remove();
            });

            window._EPYTA_.demoBackgroundColor();
            window._EPYTA_.demoTextColor();
            window._EPYTA_.demoFontFamily();
            window._EPYTA_.demoFontSize();

            $(window._EPYTA_.escId('vi_js_settings[backgroundColor]')).wpColorPicker({
                change: window._EPYTA_.demoBackgroundColor
            });
            $(window._EPYTA_.escId('vi_js_settings[textColor]')).wpColorPicker({
                change: window._EPYTA_.demoTextColor
            });
            $(window._EPYTA_.escId('vi_js_settings[font]')).on('change', window._EPYTA_.demoFontFamily);
            $(window._EPYTA_.escId('vi_js_settings[fontSize]')).on('change', window._EPYTA_.demoFontSize);

            $.ajax({
                type: "post",
                dataType: "json",
                timeout: 12000000,
                url: window._EPYTA_.wpajaxurl,
                data: {
                    security: window._EPYTA_.security,
                    action: 'my_embedplus_vi_reports_ajax'
                },
                success: function (response)
                {
                    if (response.type === 'error' || !response.data.mtdReport.length || typeof (response.data.mtdReport[0].date) === 'undefined')
                    {
                        $('.vi-report-error').removeClass('hide');
                        $('.vi-report').addClass('hide');
                    }
                    else
                    {
                        var mtdReportXY = response.data.mtdReport.map(function (point, idx)
                        {
                            return {
                                x: moment(point.date, 'YYYY-MM-DD').format(),
                                y: point.revenue
                            };
                        });

                        $('.vi-total-earnings-num').text(window._EPYTA_.moneyFormat(response.data.netRevenue));
                        var thisMonth = moment(mtdReportXY.length ? mtdReportXY[0].x : new Date()).format('MMMM YYYY');

                        var ctx = document.getElementById("vi-report-canvas").getContext("2d");
                        var config = {
                            type: 'line',
                            data: {
                                datasets: [{
                                        label: thisMonth + " Earnings (USD)",
                                        backgroundColor: '#1193aa',
                                        borderColor: '#1193aa',
                                        fill: false,
                                        data: mtdReportXY
                                    }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    deferred: {
                                        delay: 1000
                                    },
                                },
                                title: {
                                    display: false
                                },
                                legend: {
                                    labels: {
                                        fontSize: 15,
                                        fontColor: '#000000'
                                    }
                                },
                                tooltips: {
                                    position: 'nearest',
                                    mode: 'index',
                                    intersect: false,
                                    callbacks: {
                                        label: function (tooltipItem, data)
                                        {
                                            return window._EPYTA_.moneyFormat(tooltipItem.yLabel);
                                        },
                                        title: function (tooltipItems, data)
                                        {
                                            return  moment(tooltipItems[0].xLabel).format('LL');
                                        }
                                    }
                                },
                                scales: {
                                    xAxes: [{
                                            type: "time",
                                            time: {
                                                unit: 'day',
                                                unitStepSize: 1,
                                                displayFormats: {
                                                    'day': 'MMM DD'
                                                }
                                            },
                                            display: true,
                                            scaleLabel: {
                                                display: true,
                                                labelString: 'Date',
                                                fontSize: 15,
                                                fontColor: '#000000'
                                            },
                                            ticks: {
                                                major: {
                                                    fontStyle: "bold",
                                                    fontColor: "#000000"
                                                }
                                            }
                                        }],
                                    yAxes: [{
                                            display: true,
                                            scaleLabel: {
                                                display: true,
                                                labelString: 'Revenue',
                                                fontSize: 15,
                                                fontColor: '#000000'
                                            },
                                            ticks: {
                                                // Include a dollar sign in the ticks
                                                callback: function (value, index, values)
                                                {
                                                    return window._EPYTA_.moneyFormat(value);
                                                }
                                            }
                                        }]
                                }
                            }
                        };
                        Chart.defaults.global.defaultFontFamily = "'Segoe UI', Roboto, 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif";
                        var revenueLine = new Chart(ctx, config);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError)
                {
                    alertify.alert('Sorry, there was a network error. Please try again. If the issue persists, please contact ext@embedplus.com');
                },
                complete: function ()
                {

                }
            });


            $('.ytvi-btn-logout').on('click', function ()
            {
                var multiCatWarning = '';
                var iabValRaw = $('.iab-cat-tags').val();
                if (iabValRaw.length > 0 && iabValRaw.split(',').length > 1)
                {
                    multiCatWarning = ' (Note: If you selected more than one video category, you must stay logged in to this settings page for your categories to automatically add variety to your ads)';
                }
                alertify.confirm().set({
                    title: "Logout of Monetize settings",
                    message: "Logging out won't delete your settings. However, it will require you or any other admins to re-login to change vi ad settings in the future" + multiCatWarning + ".<br><br>To actually disable monetization, make sure the '<strong>vi ads are: On/Off</strong>' button is set to '<strong>Off</strong>.'",
                    onok: function ()
                    {
                        $.ajax({
                            type: "post",
                            dataType: "json",
                            timeout: 12000000,
                            url: window._EPYTA_.wpajaxurl,
                            data: {
                                security: window._EPYTA_.security,
                                action: 'my_embedplus_vi_logout_ajax'
                            },
                            success: function (response)
                            {
                                if (response.type === 'error')
                                {
                                    alertify.alert(response.message);
                                }
                                else
                                {
                                    location.href = response.url;
                                }
                            },
                            error: function (xhr, ajaxOptions, thrownError)
                            {
                                alertify.alert('Sorry, there was a network error. Please try again. If the issue persists, please contact ext@embedplus.com');
                            },
                            complete: function ()
                            {
                            }
                        });
                    }
                }).show();

            });

        }

        $('.ytvi-btn-toggle').on('click', function ()
        {
            var $btn = $(this);
            alertify.confirm().set({
                title: ($btn.hasClass('ytvi-btn-active') ? "Turn off" : "Turn on") + " your vi ads",
                message: $btn.hasClass('ytvi-btn-active') ? "Are you sure you would like to deactivate your video ads? Please note that your ads will no longer appear on the front end and your revenue will be paused. If you would like them to reappear later, simply click on this button again." :
                        "Click OK to confirm turning on your vi ads. They will appear on your site according to your <strong>Placement</strong> settings.",
                onok: function ()
                {
                    $.ajax({
                        type: "post",
                        dataType: "json",
                        timeout: 12000000,
                        url: window._EPYTA_.wpajaxurl,
                        data: {
                            security: window._EPYTA_.security,
                            action: 'my_embedplus_vi_toggle_ajax'
                        },
                        success: function (response)
                        {
                            if (response.type === 'error')
                            {
                                alertify.alert(response.message);
                            }
                            else
                            {
                                $btn.find('strong').text(response.button_text);
                                $btn.toggleClass('ytvi-btn-active ytvi-btn-inactive');
                                if ($btn.hasClass('ytvi-btn-active'))
                                {
                                    $('.ytvi-msg-congrats').show(200);
                                }
                                else
                                {
                                    $('.ytvi-msg-congrats').hide();
                                }
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError)
                        {
                            alertify.alert('Sorry, there was a network error. Please try again. If the issue persists, please contact ext@embedplus.com');
                        },
                        complete: function ()
                        {
                        }
                    });
                }
            }).show();

        });

        $('.ytvi-intro-video-modal').on('click', function (e)
        {
            e.preventDefault();
            var w = Math.min(document.body.clientWidth * .8, 800);
            var h = 9 / 16 * w;
            alertify.YoutubeDialog('BcrNPnWUkVI').set({frameless: true, resizeable: true}).resizeTo(w, h);
        });

        $('#vi_show_gdpr_authorization').on('change', function ()
        {
            if ($(this).is(':checked'))
            {
                $('.opt_vi_show_privacy_button').show(300);
            }
            else
            {
                $('.opt_vi_show_privacy_button').hide(300);
            }
        });

        /////////////////////////////// onboarding
        if ($('.wrap-ytprefs-onboarding').length)
        {
            // global
            $('.ytprefs-ob-nav-close').on('click', function ()
            {
                window.parent.tb_remove();
                window.top.location.reload();
            });

            $('.ytprefs-ob-nav-prev').on('click', function ()
            {
                window._EPYTA_.onboardPrev($(this).closest('.ytprefs-ob-step'));
            });

            //////////////////////////////////////////////////////////////////////////////////////////////////////////////// step 1

            $('.ytprefs-ob-filter li').hover(function ()
            {
                var sel = '.' + $(this).find('input[type="checkbox"]').data('obfilter') + '-icon';
                $(sel).addClass('yob-icon-visible');
            }, function ()
            {
                var sel = '.' + $(this).find('input[type="checkbox"]').data('obfilter') + '-icon';
                $(sel).removeClass('yob-icon-visible');
            });


            $('.ytprefs-ob-filter input[type="checkbox"]').on('change', function ()
            {
                var $chk = $(this);
                var obfilter = $chk.data('obfilter');

                var $allChecked = $('.ytprefs-ob-filter input[type="checkbox"]:checked');
                if ($allChecked.length && !($allChecked.length === 1 && $allChecked.is('[data-obfilter="yob-monetize"]')))
                {
                    $('.ytprefs-ob-step1 .ytprefs-ob-nav-next').prop('disabled', false);
                }
                else
                {
                    $('.ytprefs-ob-step1 .ytprefs-ob-nav-next').prop('disabled', true);
                }

                if (obfilter == 'yob-monetize')
                {
                    $('.ytprefs-ob-step3 .ytprefs-ob-nav-ultimate, .ytprefs-ob-step3 .ytprefs-ob-nav-penultimate').toggleClass('ytprefs-ob-nav-hide');
                }
                else
                {
                    if ($chk.is(":checked"))
                    {
                        $('.ytprefs-ob-step2 .' + obfilter).addClass(obfilter + '-visible');
                    }
                    else
                    {
                        $('.ytprefs-ob-step2 .' + obfilter).removeClass(obfilter + '-visible');
                    }
                }

            });


            $('.ytprefs-ob-step1 .ytprefs-ob-nav-next').on('click', function ()
            {
                window._EPYTA_.onboardNext($(this).closest('.ytprefs-ob-step'));
            });


            //////////////////////////////////////////////////////////////////////////////////////////////////////////////// step 2
            $('#form-onboarding').on('submit', function (e)
            {
                e.preventDefault();
                (window.tinyMCE || window.tinymce).triggerSave();
                var $formOnboarding = $(this);
                $formOnboarding.find('.ytprefs-ob-nav-next').prop('disabled', true);

                var formData = $formOnboarding.ytprefsFormJSON();
                formData.security = window._EPYTA_.security;

                $.ajax({
                    type: "post",
                    dataType: "json",
                    timeout: 30000,
                    url: window._EPYTA_ ? window._EPYTA_.wpajaxurl : ajaxurl,
                    data: formData,
                    success: function (response)
                    {
                        if (response.type == "success")
                        {

                            window._EPYTA_.onboardNext($formOnboarding.closest('.ytprefs-ob-step'));
                        }
                        else
                        {
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError)
                    {
                    },
                    complete: function ()
                    {
                        $formOnboarding.find('.ytprefs-ob-nav-next').prop('disabled', false);
                    }

                });

            });

            //////////////////////////////////////////////////////////////////////////////////////////////////////////////// step 3
            $('.ytprefs-ob-step3 .ytprefs-ob-nav-skip').on('click', function ()
            {
                window._EPYTA_.onboardNext($(this).closest('.ytprefs-ob-step'));
            });

            $('#form-onboarding-apikey').on('submit', function (e)
            {
                e.preventDefault();
                var $formOnboarding = $(this);
                $formOnboarding.find('.ytprefs-ob-nav-next').prop('disabled', true);

                var formData = $formOnboarding.ytprefsFormJSON();
                formData.security = window._EPYTA_.security;

                $.ajax({
                    type: "post",
                    dataType: "json",
                    timeout: 30000,
                    url: window._EPYTA_ ? window._EPYTA_.wpajaxurl : ajaxurl,
                    data: formData,
                    success: function (response)
                    {
                        if (response.type == "success")
                        {
                            if ($formOnboarding.find('.ytprefs-ob-nav-ultimate').hasClass('ytprefs-ob-nav-hide'))
                            {
                                window._EPYTA_.onboardNext($formOnboarding.closest('.ytprefs-ob-step'));
                            }
                            else
                            {
                                window.parent.tb_remove();
                                window.top.location.reload();
                            }

                        }
                        else
                        {
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError)
                    {
                    },
                    complete: function ()
                    {
                        $formOnboarding.find('.ytprefs-ob-nav-next').prop('disabled', false);
                    }

                });

            });



        } // end onboarding

    }); // end ready
    $(window).on('load', function ()
    {
        if (_EPYTA_.onboarded != '1')
        {
            $('.ytprefs-onboarding-launch').click();
        }
    }); // end onload
})(window, jQuery);