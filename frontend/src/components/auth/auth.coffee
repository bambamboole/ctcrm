authModule = angular.module "ctcrm.components.auth", []

authModule.service 'auth', ($http, $state) ->
  roles:
    user:   { bitMask: 1, title: 'user' }
    admin:  { bitMask: 2, title: 'admin'}
  accessLevels:
    user:   { bitMask: 3, title: 'user' }
    admin:  { bitMask: 2, title: 'admin'}

  loginError: false
  currentUser: null

  login: (username, password) ->
    credentials =
      username: username
      password: password
    $http.post('backend/login', credentials)
    .success (user) =>
      @currentUser = user
      $state.go 'main'
    .error =>
      @loginError = 'Username oder Passwort falsch'

  logout: ->
    console.log 'logout'
    @currentUser = null
    $state.go 'login'

  isLoggedIn: ->
    !!@currentUser

  isAllowed: (accessLevel) ->
    role = @currentUser?.role || {bitMask: 1}
    !!(@accessLevels[accessLevel].bitMask & role.bitMask)
