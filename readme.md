# Installation:

Mem can be run standalone when the host machine is properly configured, or in Homestead, where the configuration is done automatically through a Vagrant virtual machine. The instructions below are for running using Homestead Improved, which simplifies the setup process for developing with Homestead.

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
   ```bash
   vagrant ssh
   cd Code/Project
   composer update
   ```
6. **Configure the project environment.**

   First, create an environment file:
   
   ```bash
   cp .env.example .env
   nano .env
   ```
   
   Update `APP_KEY` to something appropriate. The **CodeIgniter Encryption Keys** section of https://randomkeygen.com works well for this purpose, as Lumen does not provide a `key:generate` utility, which is available in full Laravel distributions.
7. **Configure the database and insert initial data.**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
8. **Use the app!** Visit `homestead.app` (or whatever host you configured in step 2) in a web browser.
   
   To login, click the link in the navigation bar.
   
    - Test email: `test@test.com`
    - Test password: `$sh4rpspr1nG$`