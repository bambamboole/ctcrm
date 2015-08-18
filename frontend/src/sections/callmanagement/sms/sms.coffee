smsModule = angular.module "ctcrm.sections.sms", []


smsModule.config  ($stateProvider) ->
  $stateProvider.state "main.sms",
    url: "anrufverwaltung/sms"
    controller: "SmsCtrl"
    templateUrl: "sections/callmanagement/sms/sms.tpl.html"

smsModule.controller 'SmsCtrl', ($scope) ->
  $scope.test = 'ciao'
  @