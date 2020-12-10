<?php namespace Modules\Slider\Repositories\Cache;

use Modules\Core\Repositories\Cache\BaseCacheDecorator;
use Modules\Slider\Repositories\SlideApiRepository;

class CacheSlideApiDecorator extends BaseCacheDecorator implements SlideApiRepository
{
    /**
     * @var SliderRepository
     */
    protected $repository;

    public function __construct(SliderRepository $slider)
    {
        parent::__construct();
        $this->entityName = 'sliders';
        $this->repository = $slider;
    }

    /**
     * Get all online sliders
     * @return object
     */
    public function allOnline()
    {
        return $this->remember(function () {
            return $this->repository->allOnline();
        });
    }

    /**
     * @param $id
     * @param $include
     * @return mixed
     */
    public function show($id, $include)
    {
        return $this->remember(function () use ($id, $include) {
            return $this->repository->index($id, $include);
        });
    }

    /**
     * @param $page
     * @param $take
     * @param $filter
     * @param $include
     * @return array|mixed
     */
    public function index($page, $take, $filter, $include)
    {
        return $this->remember(function () use ($page, $take, $filter, $include) {
            return $this->repository->index($page, $take, $filter, $include);
        });
    }

    /**
     * update a resource
     *
     * @param $criteria
     * @param $data
     * @param $params
     * @return mixed
     */
    public function updateBy($criteria, $data, $params)
    {
        $this->clearCache();

        return $this->repository->updateBy($criteria, $data, $params);
    }

    /**
     * destroy a resource
     *
     * @param $criteria
     * @param $params
     * @return mixed
     */
    public function deleteBy($criteria, $params)
    {
        $this->clearCache();

        return $this->repository->deleteBy($criteria, $params);
    }
}
