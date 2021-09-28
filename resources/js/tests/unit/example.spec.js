import { mount } from '@vue/test-utils';
import HelloWorld from '../../components/HelloWorld';

describe('HelloWorld.vue', () => {
  it('renders component', () => {
    const wrapper = mount(HelloWorld);
    expect(wrapper.text()).toMatch('Hello World');
  });
});
