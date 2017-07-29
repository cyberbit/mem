# Installation

Mem can be run standalone when the host machine is properly configured, or in [Laravel Homestead](https://laravel.com/docs/5.4/homestead), where the configuration is done automatically through a Vagrant virtual machine. The instructions below are for running using [Homestead Improved](https://www.sitepoint.com/quick-tip-get-homestead-vagrant-vm-running/), which simplifies the setup process for developing with Homestead.

## Requirements
 - [**VirtualBox**](http://virtualbox.org/)
 - [**Vagrant**](https://www.vagrantup.com/)
 - [**Git**](https://git-scm.com/downloads) (**Git Tools** if on Windows).

1. **Set up the Homestead Improved VM.** Run the following in a bash-like prompt (on Windows, use Git Bash):
   ```bash
   git clone https://github.com/swader/homestead_improved mem
   cd mem
   bin/folderfix.sh
   ```
2. **Set up `etc/hosts`.**

   First, find your `etc/hosts` file. On OS X and Linux it's `/etc/hosts`, and on Windows it's `C:/Windows/System32/drivers/etc/hosts`. Add a line like this:
   
   ```
   192.168.10.10 homestead.app
   ```
   
   > If you change `homestead.app` to something else, be sure to update the `sites` key in `Homestead.yaml` to match.
3. **Clone Mem into `Project`.**
   ```bash
   git clone https://github.com/cyberbit/mem Project
   ```
4. **Boot up the Vagrant box.**
   ```bash
   vagrant up
   ```
5. **Connect to the VM and install dependencies.**
   
   > From this point on, lines beginning with `$` indicate commands run inside the VM.
   
   ```bash
   vagrant ssh
   $ cd Code/Project
   $ composer install
   ```
6. **Configure the project environment.**

   First, create an environment file:
   
   ```bash
   $ cp .env.example .env
   $ nano .env
   ```
   
   Update `APP_KEY` to something appropriate. The **CodeIgniter Encryption Keys** section of https://randomkeygen.com works well for this purpose, as Lumen does not provide a `key:generate` utility, which is available in full Laravel distributions.
7. **Configure the database and insert initial data.**
   ```bash
   $ php artisan migrate
   $ php artisan db:seed
   ```
8. **Use the app!** Visit `homestead.app` (or whatever host you configured in step 2) in a web browser.
   
   To login, click the link in the navigation bar.
   
    - Test email: `test@test.com`
    - Test password: `$sh4rpspr1nG$`

## API Documentation

Included in the repository are two files: `postman.json` and `postman.csv`, a request collection and test dataset for use with [Postman](https://www.getpostman.com/).

1. Import `postman.json` into Postman as a collection. This will add a collection named "Mem", and set up over a dozen requests spanning all the features of the app (including error handling and authentication).
2. Add an environment (Manage Environments > Add) and set the `wroot` variable to the web root of the app (`homestead.app` by default). Be sure to select the new environment after adding the variable.
3. Send the `/api` request. If all is well, a friendly greeting should appear in the response window.

### Testing

The order of commands in the collection is set up for easy unit testing in Postman.

1. In Postman, click Runner.
2. Select the Mem collection and the Mem environment.
3. For Data File, pick `postman.csv` from the repository.
4. Click Run. Test results will appear on the right hand side of the window.

The source for these tests can be found in the Tests tab of each request.
