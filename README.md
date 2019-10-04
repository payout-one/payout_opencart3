# Payout payment module for OpenCart 3

The [OpenCart](https://www.opencart.com/) module for Payout payment gateway.
The extension provides access to the [Payout](https://payout.one/) IE API and allow merchants card payments.

## Features

* Card payments
* Multi-language (english, slovak, czech)
* Multi-currency

## Requirements

* PHP 5.5 or later
* cUrl extension enabled
* Payout API Client PHP Library [GitHub](https://github.com/payout-one/payout_php)
* Payout account

## Getting Started

You can install the extension using either OCMOD modification system or upload files with through FTP.
The [Payout API Client PHP Library]((https://github.com/payout-one/payout_php)) is included in the installation files.

### A) Installation using OpenCart OCMOD modification system

1. Download `.ocmod.zip` installation file from [GitHub Releases](https://github.com/payout-one/payout_opencart3/releases).
2. Login to Your Store admin section and navigate to __Extensions__ > __Installer__.
3. Upload the `.ocmod.zip` file.
4. If you see green notification, the files has been successfully uploaded.

### B) Manual installation using FTP file upload

1. Download `.ocmod.zip` installation file from [GitHub Releases](https://github.com/payout-one/payout_opencart2/releases).
2. Unzip downloaded file.
3. Use any FTP client to upload files form `upload` directory to Your Store `root` on your web-server. 

### Configuration

1. Navigate to __Extensions__ > __Extensions__ > __Payments__ in Your Store admin section.
2. Scroll down to the Payout extension and click on green __Install__ button.
3. Click on blue __Edit__ button.
4. Copy __Notification URL__ and generate API key in your Payout Banking.
5. Set __API Key ID__ and __Secret__.
6. For testing purposes you can set Sandbox and Debug modes to Yes.
7. Set Status to __Enabled__
8. Click on __Order Statuses__ tab and set a corresponding statuses.
New order will be automatically changed to the status according to payment result.
9. Set Notify Customer to Yes, if you want send email when order status changes.
10. __Save__ settings by click on blue button on top right corner.

## Version

Stable version: 1.0.0

See the [CHANGELOG.md](CHANGELOG.md) file for list off all changes.

## Compatibility

* Tested with OpenCart 3.0.3.2
* Tested with Payout API

## Documentation

The [Payout API](https://postman.payout.one/?version=latest) documentation.

## License

This open-source software is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

Copyright © 2019 [Payout, s.r.o.](https://payout.one/)