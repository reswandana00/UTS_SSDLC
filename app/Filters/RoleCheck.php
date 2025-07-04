// app/Filters/RoleCheck.php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $role = $arguments[0] ?? null;

        if (!$session->has('username') || !$session->has('role')) {
            return redirect()->to('/login');
        }

        // Validasi role dan waktu hak akses
        if ($role && $session->get('role') !== $role) {
            return redirect()->to('/unauthorized');
        }

        $expire = $session->get('access_expires');
        if ($expire && strtotime($expire) < time()) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Access expired');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
