<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\InventoryMovement;
use App\Models\Notification;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    // عرض كل المشتريات
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'product'])->get();
        return view('purchases.index', compact('purchases'));
    }

    // نموذج إنشاء عملية شراء
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('purchases.create', compact('suppliers', 'products'));
    }

    // تخزين عملية شراء جديدة
    public function store(Request $request)
    {

        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        $purchase = Purchase::create($request->all());

        $product = Product::findOrFail($purchase->product_id);
        $product->quantity += $purchase->quantity;
        $product->save();

        // سجل حركة المخزون
        InventoryMovement::create([
            'product_id' => $product->id,
            'quantity' => $purchase->quantity,
            'type' => InventoryMovement::TYPE_PURCHASE, // تأكد أن هذا متوافق مع ENUM في جدول inventory_movements
        ]);

        // تحقق من الحد الأدنى
        $this->checkMinimumStock($product);

        return redirect()->route('purchases.index')->with('success', 'Purchase created successfully.');
    }

    // عرض تفاصيل عملية شراء
    public function show(Purchase $purchase)
    {
        return view('purchases.show', compact('purchase'));
    }

    // نموذج تعديل عملية شراء
    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('purchases.edit', compact('purchase', 'suppliers', 'products'));
    }

    // تحديث عملية شراء
    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        $oldQuantity = $purchase->quantity;
        $purchase->update($request->all());

        $product = Product::findOrFail($purchase->product_id);
        $product->quantity = $product->quantity - $oldQuantity + $purchase->quantity;
        $product->save();

        InventoryMovement::create([
            'product_id' => $product->id,
            'quantity' => $purchase->quantity - $oldQuantity,
            'type' => InventoryMovement::TYPE_PURCHASE,
        ]);

        $this->checkMinimumStock($product);

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully.');
    }

    // حذف عملية شراء
    public function destroy(Purchase $purchase)
    {
        $product = Product::findOrFail($purchase->product_id);
        $product->quantity -= $purchase->quantity;
        $product->save();

        InventoryMovement::create([
            'product_id' => $product->id,
            'quantity' => -$purchase->quantity,
            'type' => InventoryMovement::TYPE_PURCHASE_DELETED,
        ]);

        $purchase->delete();

        $this->checkMinimumStock($product);

        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }

    // دالة للتحقق من الحد الأدنى وإرسال إشعار إذا انخفض المخزون
    private function checkMinimumStock(Product $product)
    {
        if ($product->quantity <= $product->min_quantity) {
            Notification::create([
                'type' => 'stock',
                'message' => "Product {$product->name} is below minimum stock.",
                'product_id' => $product->id,
            ]);
        }
    }
}
