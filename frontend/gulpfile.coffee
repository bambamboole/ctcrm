gulp        = require "gulp"
gutil       = require "gulp-util"
plugins     = require("gulp-load-plugins")(lazy: false)
compile     = require "gulp-compile-js"
chalk       = require "chalk"
path        = require "path"
karma       = require 'gulp-karma'
bowerFiles  = require 'main-bower-files'
templatecache = require 'gulp-angular-templatecache'


server =
  port: 2342
  livereloadPort: 35729
  basePath: path.join(__dirname)
  _lr: null
  started: null
  start: ->
    console.log chalk.white("Start Express")
    express = require("express")
    app = express()
    app.use require("connect-livereload")()
    app.use express.static(server.basePath)
    app.listen server.port

    app.get '/', (req, res) ->
      res.redirect 'demo/'

    console.log chalk.cyan("Express started: #{server.port}")
    server.started = true


  livereload: ->
    server._lr = require("tiny-lr")()
    server._lr.listen server.livereloadPort
    console.log chalk.cyan("Live-Reload on: #{server.livereloadPort}")


  livestart: ->
    server.start()
    server.livereload()


  notify: (event) ->
    fileName = path.relative(server.basePath, event.path)
    server._lr.changed body:
      files: [fileName]



gulp.task "scripts", ->
  sources =[
    "!./src/**/*.spec.coffee"
    "!./src/demo.coffee"
    "./src/**/*.coffee"
  ]
  gulp.src(sources)
  .pipe(
    compile
      coffee:
        bare: true
  )
  .pipe(plugins.concat("ctcrm.js"))
  .pipe gulp.dest("./assets")




gulp.task 'buildTemplates', ->
  gulp.src('src/**/*.tpl.html')
  .pipe(templatecache( module:'ctcrm.templates', standalone:true ))
  .pipe(plugins.concat("templates.js"))
  .pipe(gulp.dest('./assets/'))



gulp.task "buildCSS", ->
  sources =[
    "./src/**/*.css"
    "./src/*.css"
  ]
  gulp.src(sources)
  .pipe(plugins.concat("ctcrm.css"))
  .pipe gulp.dest("./assets/css")


gulp.task "buildVendorCSS", ->
  sources =[
    "./bower_components/bootstrap-css-only/css/bootstrap.css"
    "./bower_components/angular-ui-select/dist/select.css"
    "./bower_components/angular-ui-select/dist/select2.css"
    "./bower_components/ng-table/dist/ng-table.min.css"
    "./bower_components/components-font-awesome/css/font-awesome.css"
  ]
  gulp.src(sources)
  .pipe(plugins.concat("vendor.css"))
  .pipe gulp.dest("./assets/css")


gulp.task "copyFonts", ->
  sources =[
    "./bower_components/bootstrap-css-only/fonts/*.*"
    "./bower_components/components-font-awesome/fonts/*.*"
  ]
  gulp.src(sources)
  .pipe gulp.dest("./assets/fonts")


gulp.task "copyData", ->
  sources =[
    "./src/data/*.json"
  ]
  gulp.src(sources)
  .pipe gulp.dest("./assets/data")


gulp.task "buildVendorJS", ->
  sources = bowerFiles(filter:'**/*.js')
  sources.push "./bower_components/momentjs/locale/de.js"
  gulp.src(sources, base: './bower_components/')
  .pipe(plugins.concat("vendor.js"))
  .pipe gulp.dest("./assets/lib")


gulp.task "livereload", ->
  server.livestart()


gulp.task "watch", ->
  sources = [
    "./src/**/*.coffee"
  ]
  gulp.watch sources, ["scripts"]

gulp.task "watchBuildFiles", ->
  sources = [
    "./assets/**/*.js"
    "./assets/**/*.css"
  ]
  watcher = gulp.watch sources,["deploy"]
  watcher.on 'change', (event) ->
    server.notify event



gulp.task "watchCSS", ->
  sources = [
    "./src/**/*.css"
    "./src/*.css"
  ]
  gulp.watch sources, ["buildCSS"]



gulp.task "watchTemplates", ->
  sources = [
    "./src/**/*.tpl.html"
  ]
  watcher = gulp.watch sources, ["buildTemplates"]
  watcher.on 'change', (event) ->
    server.notify event

gulp.task "deploy", ->
  sources = [
    "./assets/**/*"
  ]
  gulp.src(sources)
  .pipe gulp.dest("../assets/")

gulp.task "karma-unit", ->
  gulp.src('./idontexist')
  .pipe(karma
      configFile: './karma-unit.coffee'
      action: 'watch'
  )
  .on 'error', (err) ->

gulp.task "default", [
  "scripts"
  "buildTemplates"
  "buildCSS"
  "buildVendorJS"
  "buildVendorCSS"
  "copyFonts"
  "copyData"
  "livereload"
  "watch"
  "watchBuildFiles"
  "watchCSS"
  "watchTemplates"
  "karma-unit"
]