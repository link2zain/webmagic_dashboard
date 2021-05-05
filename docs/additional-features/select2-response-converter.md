## Select 2 Response converter

``\Webmagic\Dashboard\Adapters\Select2ResponseConverter``

This trait provide simple function which will be helpful when you need to return regular array or array of Models in formatted array which will be acceptable for Select2 

### How to use
Simply use trait in need class and you will be able to use simple functions

```php
use \Webmagic\Dashboard\Adapters\Select2ResponseConverter;

class ApiController extends Controller
{
    use \Webmagic\Dashboard\Adapters\Select2ResponseConverter;
    
    public function returnRegularArrayForSelect2(){
        $testArray = ['12' => 'London', '34' => 'Paris'];
        
        $preparedArray = $this->convertArrayToSelect2Format($testArray);
        
        return response()->json($preparedArray);
    }

    public function returnComplexArrayForSelect2(){
        $testArray = [['name' => 'London', 'key' => '12'],['name' => 'Paris', 'key' => '34']];
        
        // Define keys for needed fields in complex array            
        $preparedArray = $this->convertArrayToSelect2Format($testArray, 'name', 'key');
        
        return response()->json($preparedArray);
    }

    public function returnModelsForSelect2(){
        /** @var \Illuminate\Support\Collection $testCollection */
        $testCollection = App\SomeModel::all();
        
        // Define keys for needed fields in complex array            
        $preparedArray = $this->convertModelsToSelect2Format('id', 'name', $testCollection->all());
        
        return response()->json($preparedArray);
    }
}
```

More details about Select 2 data format can be found on the official website - https://select2.org/data-sources/formats   
