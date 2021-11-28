$(function () {
  if(nlb_widget_key){
    $.ajax({
      url: "https://api.nlb.astennu.com/api/v1/widget/validate",
      headers:{
        'X-Authorization': nlb_widget_key,
        'Accept': 'application/json',
      },
      method: 'POST',
      dataType: 'json',
      success: function(){
        main()
      }
    })
  }
  function main()
  {
  let styleLink = document.createElement('link');
  styleLink.rel = 'stylesheet';
  styleLink.type = 'text/css';
  styleLink.href = 'https://api.nlb.astennu.com/cdn/widget-style.css';
  document.getElementsByTagName('HEAD')[0].appendChild(styleLink);

  //Splash screen
  let divSplashScreen = $("<div/>");
  let divSplashScreenData = $("<div/>");
  let imgSplashScreen = $("<img/>");
  imgSplashScreen.attr("src", "https://api.nlb.astennu.com/cdn/img/widget-splash-screen-img.png");
  $(divSplashScreen).addClass("div-splash-screen");

  $(imgSplashScreen).addClass("img-splash-screen");

  let p = $("<p/>");
  let p1 = $("<p/>");
  let a = $("<a/>");
  let i = $("<i/>");
  $(i).addClass("fas fa-lock lock");

  $(p)
    .text(`NLB Open Finance will only be able to read your data`)
    .prepend($(i))
    .addClass("text1 p")
    .css({
      fontWeight: "700",
      position: "relative",
    });

  $(p1)
    .text(
      "Our platform uses the highest security standards to protect our customers’ account information and their privacy at every step of the process."
    )
    .css({
      marginLeft: "20px",
      marginRight: "10px",
      fontWeight: "400",
      opacity: "50%",
      textAlign: "left",
    })
    .addClass("text1 p");
  $(a)
    .text("How NLB Open Finance protect your account")
    .attr("href", "#")
    .addClass("link text1");
  let btnDiv = $("<div/>");
  let personalBtn = $("<button/>");
  let businessBtn = $("<button/>");
  let btnP = $("<p/>");
  $(btnDiv).css({
    marginTop: "150px",
  });
  $(personalBtn).text("Personal").addClass("widget-custom-button");
  $(businessBtn)
    .text("Business")
    .addClass("widget-custom-button")
    .css({ marginTop: "20px" });
  $(btnP)
    .text(
      "By chooseing one of the above you are accepting the privacy policy of NLB Open finance"
    )
    .addClass("text1")
    .css({
      fontSize: "10px",
      fontWeight: "400",
      color: "#979797",
      textAlign: "center",
    });

  $(btnDiv).append($(personalBtn), $(businessBtn), $(btnP));

  $(divSplashScreenData)
    .append($(p), $(p1), $(a), $(btnDiv))
    .css({ marginTop: "160px" });

  divSplashScreen.append(imgSplashScreen, $(divSplashScreenData));

  //Choose country screen
  let divChooseCountry = $("<div/>");
  let title = $("<h2/>");
  let divBtns = $("<div/>");
  let backLink = $("<a/>");
  backLink
    .html(
      '<img style="width:100%;display:block" src="https://api.nlb.astennu.com/cdn/img/long-arrow-alt-left.png"/>'
    )
    .css({
      position: "absolute",
      top: "20px",
      left: "15px",
      display: "block",
      padding: "10px",
    })
    .on("click", function () {
      window.history.back();
    });
  $(title).text("Choose your country").css({ textAlign: "center" });
  divChooseCountry
    .addClass("div-choose-country")
    .append(backLink, title, divBtns);

  let btnCountry = $("<button/>");
  btnCountry
    .addClass("btn-country")
    .text("Macedonia")
    .attr("id", "macedonia")
    .on("click", function () {
      window.location.hash = `#country#choose`;
    });
  divBtns.append(btnCountry).css({
    marginTop: "130px",
  });

  $(personalBtn).on("click", function () {
    window.location.hash = "#country";
  });

  //Chose bank or app

  let divChooseBankApp = $("<div/>");
  let divBtnBankApp = $("<div/>");
  let btnBank = $("<button/>");
  let btnApp = $("<button/>");
  let divBankAppCards = $("<div/>");
  btnBank
    .addClass("choose-btn active")
    .text("Choose Bank")
    .css({ marginRight: "10px" })
    .on("click", function (e) {
      if (!$(e.currentTarget).hasClass("active")) {
        $(e.currentTarget).addClass("active");
        $(btnApp).removeClass("active");
      }
    });

  btnApp
    .addClass("choose-btn")
    .text("Choose App")
    .css({ marginLeft: "10px" })
    .on("click", function (e) {
      if (!$(e.currentTarget).hasClass("active")) {
        $(e.currentTarget).addClass("active");
        $(btnBank).removeClass("active");
      }
    });

  divBtnBankApp
    .append(btnBank, btnApp)
    .css({ display: "flex", justifyContent: "space-between" });

    $.ajax({
      url: "https://api.nlb.astennu.com/api/v1/widget/banks",
      headers:{
        'X-Authorization': nlb_widget_key,
        'Accept': 'application/json',
      },
      method: 'POST',
      dataType: 'json',
      success: function(data){
        $.each(data.data.banks, function(i, item) {
          let cards = $("<a/>");
          cards
            .addClass("widget-custom-cards")
            .attr("id", item.slug)
            .append("<div style='height: 100px;'><img src='" + item.image + "' /></div>");

          cards.on("click", function (e) {
            window.location.hash = "#login";
            $('form').attr('action', item.login_route);
          });
          divBankAppCards.append(cards);
      });
      }
    })
 

  divBankAppCards.css({ display: "flex", flexWrap: "wrap", marginTop: "35px" });

  divChooseBankApp
    .addClass("div-choose-bank-app")
    .append(divBtnBankApp, divBankAppCards);

  //Log in screen

  let divLogIn = $("<div/>");
  let titleLogIn = $("<h2/>");
  let divLogInForm = $("<div/>");
  let logInForm = $("<form/>");
  let logInBtn = $("<button type='submit'/>");
  let logInBtnDiv = $("<div/>");
  let divErrors = $("<div/>");
  let divAccount = $("<div/>");


  titleLogIn.text("Creditentials").css({ textAlign: "center" });
  divLogIn.addClass("div-log-in").append(titleLogIn);

  divLogInForm.css({
    marginTop: "80px",
  });

  logInForm.addClass("log-in-form").append(
    `<div>
    <label for="email">Email</label>
    <input type="text" name="email" id=email required>
    </div>
    <div>
    <label for="password">Password</label>
    <input type="password" name="password" id=password required>
    </div>`
  );

  logInBtn.text("Log In").addClass("widget-custom-button").css({ marginTop: "50px" });;
  logInBtnDiv
    .append(
      logInBtn,
      "<small style='text-align:center;display:block;color:#979797;font-size:10px;margin-top:10px;line-heigth:20px;'>By hitting log in you are accepting the privacy policy of NLB Open finance</small>"
    )
    .css({ marginTop: "auto" });

  logInForm.append(logInBtnDiv);
  divLogInForm.append(logInForm);
  divLogIn.append(divLogInForm);

  $("#widget-open-finance").append(
    divSplashScreen,
    divChooseCountry,
    divChooseBankApp,
    divLogIn
  );

  $("form").submit(function(e){

    e.preventDefault();
    let email = $('#email').val();
    let password = $('#password').val();
    $.ajax({
      url: $("form").attr('action') + 'login',
      headers:{
        'Accept': 'application/json',
      },
      method: 'POST',
      dataType: 'json',
      data:{
        email: email,
        password: password,
      },
      statusCode: {
        200: function (response){
          $.ajax({
            url: $("form").attr('action') + 'info',
            headers:{
              'Accept': 'application/json',
            },
            method: 'POST',
            dataType: 'json',
            data:{
              token: response.token,
            },
            statusCode: {
              200: function (response){
                console.log(response.client)
                divSplashScreen.css({ display: "none" });
                divChooseCountry.css({ display: "none" });
                divChooseBankApp.css({ display: "none" });
                divLogIn.css({ display: "none" });
                divAccount.append("<h1>" + response.client.name + "</h1>");
                divAccount.append("<h1>" + response.client.surname + "</h1>");
                divAccount.append("<h1>" + response.client.email + "</h1>");
                $.each(response.client.accounts, function(i, account) {
                  console.log(account)
                });
                $("#widget-open-finance").append(divAccount);
              }
            }
          });
        },
        422: function (e){
          $.each(e.responseJSON.errors, function(i, error) {
            console.log(error[0])
          });
        },
        401: function (e){
          console.log(e.responseJSON.message);
        }
      },
    })
  });

  //Router function
  function handleRoute() {
    let path = window.location.hash;
    console.log(path);
    switch (path) {
      case "":
        divSplashScreen.css({ display: "block" });
        divChooseCountry.css({ display: "none" });
        divChooseBankApp.css({ display: "none" });
        divLogIn.css({ display: "none" });
        break;
      case "#country":
        divSplashScreen.css({ display: "none" });
        divChooseCountry.css({ display: "block" }).append(backLink);
        divChooseBankApp.css({ display: "none" });

        divLogIn.css({ display: "none" });
        break;
      case `#country#choose`:
        divSplashScreen.css({ display: "none" });
        divChooseCountry.css({ display: "none" });
        divChooseBankApp.css({ display: "block" }).append(backLink);
        divLogIn.css({ display: "none" });
        break;
      case `#login`:
        divSplashScreen.css({ display: "none" });
        divChooseCountry.css({ display: "none" });
        divChooseBankApp.css({ display: "none" });
        divLogIn.css({ display: "flex" }).append(backLink);
        break;
      default:
        path = "";
        break;
    }
  }
  //On every hash change execute router function
  $(window).on("hashchange", handleRoute);

  //On every load  execute router function
  $(window).on("load", handleRoute);
  }
});
