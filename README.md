
AWS S3 Upload Functionality For JBIMAGES
========================================

Includes

1. PSR0 Compliant autoloader for non-CI classes
2. Added AWS SDK files into the repository. Although it would have been ideal to add the SDK files via composer,
considering the scale of the application, I decided to simply add in the sdk manually in `ci/vendor`. Refer to 
the SDK quick start [page](http://docs.aws.amazon.com/aws-sdk-php/guide/latest/quick-start.html). 

How to use:
Edit the config file in `ci/application/config/aws.php`. The file is pretty much self explanatory.

```
$config['s3']['enable'] = true;
$config['s3']['url'] = "http://your-s3-url/bucketname/";
$config['s3']['key'] = 'SAMPLEKEY';
$config['s3']['secret'] = 'samplesecret';
$config['s3']['bucket'] = "bucketname";
$config['s3']['allowed_types'] = 'gif|jpg|png|jpeg';
$config['s3']['max_size'] = 5000;

```
