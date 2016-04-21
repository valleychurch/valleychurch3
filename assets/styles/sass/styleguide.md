# Development guidelines
<p class="lead">This documentation is meant to serve as a guide for how to develop well for the [valleychurch.eu](valleychurch.eu) WordPress theme and other web properties.</p>

The theme is built using Sass (SCSS syntax) and Javascript, compiled with Grunt. Instructions on how to set up a local development environment are included below to get you up and running quickly.

Development structure mostly follows guidance set out by [@mdo's Code Guide](http://codeguide.co/) and [Harry Roberts' ITCSS](https://speakerdeck.com/dafed/managing-css-projects-with-itcss) so please read them both!

## Prerequisites

Before you can get started, you will need to install:
- [Ruby](http://rubyinstaller.org/) (on Windows)
- [Node.js](https://nodejs.org/en/)

## Getting started
First of all, get a copy of the [`valleychurch3`](https://github.com/valleychurch/valleychurch3/) repo, either by:
- Downloading the [latest release zip](https://github.com/valleychurch/valleychurch3/releases/latest) from GitHub; or
- Cloning the repo via command line: `git clone git://github.com/valleychurch/valleychurch3.git`

Once the folder is within a local WordPress instance running in XAMPP/IIS, open a `cmd`/PowerShell window in the correct folder and run `install.bat`.
